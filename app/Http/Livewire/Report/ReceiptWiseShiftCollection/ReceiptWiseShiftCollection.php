<?php

namespace App\Http\Livewire\Report\ReceiptWiseShiftCollection;

use App\Models\CostCenter;
use App\Models\Department;
use App\Models\IpServiceBillingItem;
use App\Models\OpdBillingItems;
use App\Models\Service\ServiceGroup;
use App\Models\User;
use Livewire\Component;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ReceiptWiseShiftCollection extends Component
{
    public $selection_type = 'user-wise', $from_date, $to_date, $patient_type = '', $area = '', $cost_center_id;
    public $user_id, $department_id, $service_group_id, $service_type_id, $sorting_order = 'desc', $search_type = 'summary-print';

    public $selection_types = [
        'user-wise' => 'User Wise',
        // 'receipt-wise' => 'Receipt Wise',
        'user-department-wise' => 'User Department Wise',
        'transaction-wise' => 'Transaction Wise',
        'service-group-wise' => 'Service Group Wise',
        'service-type-wise' => 'Service Type Wise',
        'service-department-wise' => 'Service Department Wise',
        // 'doctor-department-wise' => 'Doctor Department Wise',
    ];

    public $users = [];
    public $departments = [];
    public $service_groups = [];
    public $cost_centers = [];
    public $receipt_wise_shift_collections = [];

    public $service_types = [
        'S' => 'Service',
        'I' => 'Investigation',
        'M' => 'Miscellaneous',
        'P' => 'Procedure',
    ];

    public function mount()
    {
        $this->users = User::latest()->get();
        $this->departments = Department::get();
        $this->service_groups = ServiceGroup::get();
        $this->cost_centers = CostCenter::latest()->get();

        $this->cost_center_id = CostCenter::latest()->value("id");
        $this->from_date = now()->startOfDay()->format('Y-m-d\TH:i'); // 12:00 AM
        $this->to_date = now()->endOfDay()->format('Y-m-d\TH:i');     // 11:59 PM

    }

    public function render()
    {
        return view('livewire.report.receipt-wise-shift-collection.receipt-wise-shift-collection')->extends('layouts.admin')->section('content');
    }

    public function selectionTypeChanged()
    {
        $this->reset([
            'user_id',
            'department_id',
            'receipt_wise_shift_collections',
        ]);
    }

    public function userChanged()
    {
        $this->inputDataReset();

        $user = User::find($this->user_id);
        if ($user) {
            $this->department_id = $user->department_id;
        }
    }

    public function inputDataReset()
    {
        $this->reset('receipt_wise_shift_collections');
    }

    public function show()
    {
        $from = $this->from_date;
        $to = $this->to_date;

        switch ($this->selection_type) {
            case 'user-wise':
                $users = User::with([
                    'opd_medicine_receipts' => function ($q) use ($from, $to) {
                        $q->where('is_cancled', 0)
                            ->whereBetween('created_at', [$from, $to])
                            ->orderBy('created_at', $this->sorting_order)
                            ->when($this->patient_type, function ($q2) {
                                $q2->where('patient_type', $this->patient_type);
                            })
                            ->with([
                                'opdmedicinetransactions' => function ($q1) {
                                    $q1->where('is_cancled', 0);
                                },
                                'pharmacydue',
                                'patient' => function ($q1) {
                                    $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                        $query->where("is_rural", $this->area);
                                    });
                                }
                            ]);
                    },

                    'opd_billings' => function ($q) use ($from, $to) {
                        $q->where('is_cancled', 0)
                            ->whereBetween('created_at', [$from, $to])
                            ->orderBy('created_at', $this->sorting_order)
                            ->when($this->patient_type, function ($q2) {
                                $q2->where('patient_type', $this->patient_type);
                            })
                            ->with([
                                'opdBillingItems' => function ($q1) {
                                    $q1->where('is_cancled', 0);
                                },
                                'serviceDue',
                                'patient' => function ($q1) {
                                    $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                        $query->where("is_rural", $this->area);
                                    });
                                }
                            ]);
                    },

                    'ip_pharmacy_indent_billings' => function ($q) use ($from, $to) {
                        $q->whereBetween('created_at', [$from, $to])
                            ->orderBy('created_at', $this->sorting_order)
                            ->with([
                                'ip_billing_items',
                                'IpPharmacyDue',
                                'patient' => function ($q1) {
                                    $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                        $query->where("is_rural", $this->area);
                                    });
                                }
                            ]);
                    },

                    'ip_service_billings' => function ($q) use ($from, $to) {
                        $q->whereBetween('created_at', [$from, $to])
                            ->orderBy('created_at', $this->sorting_order)
                            ->with([
                                'billing_items',
                                'ipServiceDue',
                                'patient' => function ($q1) {
                                    $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                        $query->where("is_rural", $this->area);
                                    });
                                }
                            ]);
                    },

                    'registrations' => function ($q) use ($from, $to) {
                        $q->whereBetween('created_at', [$from, $to])
                            ->when($this->area == 0 || $this->area == 1, function ($query) {
                                $query->where("is_rural", $this->area);
                            })
                            ->orderBy('created_at', $this->sorting_order);
                    },

                    'patient_visits' => function ($q) use ($from, $to) {
                        $q->whereBetween('created_at', [$from, $to])
                            ->orderBy('created_at', $this->sorting_order)
                            ->with(['patient' => function ($q1) {
                                $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                    $query->where("is_rural", $this->area);
                                });
                            }]);
                    }
                ])
                    ->where(function ($query) use ($from, $to) {

                        // OPD Medicine
                        $query->whereHas('opd_medicine_receipts', function ($q) use ($from, $to) {
                            $q->whereHas('patient', function ($q1) {
                                $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                    $query->where("is_rural", $this->area);
                                });
                            })
                                ->where('is_cancled', 0)
                                ->whereBetween('created_at', [$from, $to])
                                ->when($this->patient_type, function ($q2) {
                                    $q2->where('patient_type', $this->patient_type);
                                });
                        })

                            // OP Bills
                            ->orWhereHas('opd_billings', function ($q) use ($from, $to) {
                                $q->whereHas('patient', function ($q1) {
                                    $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                        $query->where("is_rural", $this->area);
                                    });
                                })
                                    ->where('is_cancled', 0)
                                    ->whereBetween('created_at', [$from, $to])
                                    ->when($this->patient_type, function ($q2) {
                                        $q2->where('patient_type', $this->patient_type);
                                    });
                            })

                            // IP Pharmacy
                            ->orWhereHas('ip_pharmacy_indent_billings', function ($q) use ($from, $to) {
                                $q->whereHas('patient', function ($q1) {
                                    $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                        $query->where("is_rural", $this->area);
                                    });
                                })
                                    ->whereBetween('created_at', [$from, $to]);
                            })

                            // IP Service
                            ->orWhereHas('ip_service_billings', function ($q) use ($from, $to) {
                                $q->whereHas('patient', function ($q1) {
                                    $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                        $query->where("is_rural", $this->area);
                                    });
                                })
                                    ->whereBetween('created_at', [$from, $to]);
                            })

                            // Registrations
                            ->orWhereHas('registrations', function ($q) use ($from, $to) {
                                $q->whereBetween('created_at', [$from, $to])
                                    ->when($this->area == 0 || $this->area == 1, function ($query) {
                                        $query->where("is_rural", $this->area);
                                    });
                            })

                            // OP Consultation
                            ->orWhereHas('patient_visits', function ($q) use ($from, $to) {
                                $q->whereHas('patient', function ($q1) {
                                    $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                        $query->where("is_rural", $this->area);
                                    });
                                })
                                    ->whereBetween('created_at', [$from, $to]);
                            });
                    })
                    ->when($this->user_id, function ($query) {
                        $query->where('id', $this->user_id);
                    })
                    ->orderBy('name', $this->sorting_order)
                    ->get();

                $this->receipt_wise_shift_collections = $users;
                break;

            case 'receipt-wise':

                break;

            case 'user-department-wise':
                $users = User::with([
                    'opd_medicine_receipts' => function ($q) use ($from, $to) {
                        $q->where('is_cancled', 0)
                            ->whereBetween('created_at', [$from, $to])
                            ->orderBy('created_at', $this->sorting_order)
                            ->when($this->patient_type, function ($q2) {
                                $q2->where('patient_type', $this->patient_type);
                            })
                            ->with([
                                'opdmedicinetransactions' => function ($q1) {
                                    $q1->where('is_cancled', 0);
                                },
                                'pharmacydue',
                                'patient' => function ($q1) {
                                    $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                        $query->where("is_rural", $this->area);
                                    });
                                }
                            ]);
                    },

                    'opd_billings' => function ($q) use ($from, $to) {
                        $q->where('is_cancled', 0)
                            ->whereBetween('created_at', [$from, $to])
                            ->orderBy('created_at', $this->sorting_order)
                            ->when($this->patient_type, function ($q2) {
                                $q2->where('patient_type', $this->patient_type);
                            })
                            ->with([
                                'opdBillingItems' => function ($q1) {
                                    $q1->where('is_cancled', 0);
                                },
                                'serviceDue',
                                'patient' => function ($q1) {
                                    $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                        $query->where("is_rural", $this->area);
                                    });
                                }
                            ]);
                    },

                    'ip_pharmacy_indent_billings' => function ($q) use ($from, $to) {
                        $q->whereBetween('created_at', [$from, $to])
                            ->orderBy('created_at', $this->sorting_order)
                            ->with([
                                'ip_billing_items',
                                'IpPharmacyDue',
                                'patient' => function ($q1) {
                                    $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                        $query->where("is_rural", $this->area);
                                    });
                                }
                            ]);
                    },

                    'ip_service_billings' => function ($q) use ($from, $to) {
                        $q->whereBetween('created_at', [$from, $to])
                            ->orderBy('created_at', $this->sorting_order)
                            ->with([
                                'billing_items',
                                'ipServiceDue',
                                'patient' => function ($q1) {
                                    $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                        $query->where("is_rural", $this->area);
                                    });
                                }
                            ]);
                    },

                    'registrations' => function ($q) use ($from, $to) {
                        $q->whereBetween('created_at', [$from, $to])
                            ->when($this->area == 0 || $this->area == 1, function ($query) {
                                $query->where("is_rural", $this->area);
                            })
                            ->orderBy('created_at', $this->sorting_order);
                    },

                    'patient_visits' => function ($q) use ($from, $to) {
                        $q->whereBetween('created_at', [$from, $to])
                            ->orderBy('created_at', $this->sorting_order)
                            ->with(['patient' => function ($q1) {
                                $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                    $query->where("is_rural", $this->area);
                                });
                            }]);
                    }
                ])
                    ->where(function ($query) use ($from, $to) {

                        // OPD Medicine
                        $query->whereHas('opd_medicine_receipts', function ($q) use ($from, $to) {
                            $q->whereHas('patient', function ($q1) {
                                $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                    $query->where("is_rural", $this->area);
                                });
                            })
                                ->where('is_cancled', 0)
                                ->whereBetween('created_at', [$from, $to])
                                ->when($this->patient_type, function ($q2) {
                                    $q2->where('patient_type', $this->patient_type);
                                });
                        })

                            // OP Bills
                            ->orWhereHas('opd_billings', function ($q) use ($from, $to) {
                                $q->whereHas('patient', function ($q1) {
                                    $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                        $query->where("is_rural", $this->area);
                                    });
                                })
                                    ->where('is_cancled', 0)
                                    ->whereBetween('created_at', [$from, $to])
                                    ->when($this->patient_type, function ($q2) {
                                        $q2->where('patient_type', $this->patient_type);
                                    });
                            })

                            // IP Pharmacy
                            ->orWhereHas('ip_pharmacy_indent_billings', function ($q) use ($from, $to) {
                                $q->whereHas('patient', function ($q1) {
                                    $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                        $query->where("is_rural", $this->area);
                                    });
                                })
                                    ->whereBetween('created_at', [$from, $to]);
                            })

                            // IP Service
                            ->orWhereHas('ip_service_billings', function ($q) use ($from, $to) {
                                $q->whereHas('patient', function ($q1) {
                                    $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                        $query->where("is_rural", $this->area);
                                    });
                                })
                                    ->whereBetween('created_at', [$from, $to]);
                            })

                            // Registrations
                            ->orWhereHas('registrations', function ($q) use ($from, $to) {
                                $q->whereBetween('created_at', [$from, $to])
                                    ->when($this->area == 0 || $this->area == 1, function ($query) {
                                        $query->where("is_rural", $this->area);
                                    });
                            })

                            // OP Consultation
                            ->orWhereHas('patient_visits', function ($q) use ($from, $to) {
                                $q->whereHas('patient', function ($q1) {
                                    $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                        $query->where("is_rural", $this->area);
                                    });
                                })
                                    ->whereBetween('created_at', [$from, $to]);
                            });
                    })
                    ->when($this->user_id, function ($query) {
                        $query->where('id', $this->user_id);
                    })
                    ->when($this->department_id, function ($query) {
                        $query->where('department_id', $this->department_id);
                    })
                    ->orderBy('name', $this->sorting_order)
                    ->get();

                $this->receipt_wise_shift_collections = $users;
                break;

            case 'transaction-wise':
                $users = User::with([
                    'opd_medicine_receipts' => function ($q) use ($from, $to) {
                        $q->where('is_cancled', 0)
                            ->whereBetween('created_at', [$from, $to])
                            ->orderBy('created_at', $this->sorting_order)
                            ->when($this->patient_type, function ($q2) {
                                $q2->where('patient_type', $this->patient_type);
                            })
                            ->with([
                                'opdmedicinetransactions' => function ($q1) {
                                    $q1->where('is_cancled', 0);
                                },
                                'pharmacydue',
                                'patient' => function ($q1) {
                                    $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                        $query->where("is_rural", $this->area);
                                    });
                                }
                            ]);
                    },

                    'opd_billings' => function ($q) use ($from, $to) {
                        $q->where('is_cancled', 0)
                            ->whereBetween('created_at', [$from, $to])
                            ->orderBy('created_at', $this->sorting_order)
                            ->when($this->patient_type, function ($q2) {
                                $q2->where('patient_type', $this->patient_type);
                            })
                            ->with([
                                'opdBillingItems' => function ($q1) {
                                    $q1->where('is_cancled', 0);
                                },
                                'serviceDue',
                                'patient' => function ($q1) {
                                    $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                        $query->where("is_rural", $this->area);
                                    });
                                }
                            ]);
                    },

                    'ip_pharmacy_indent_billings' => function ($q) use ($from, $to) {
                        $q->whereBetween('created_at', [$from, $to])
                            ->orderBy('created_at', $this->sorting_order)
                            ->with([
                                'ip_billing_items',
                                'IpPharmacyDue',
                                'patient' => function ($q1) {
                                    $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                        $query->where("is_rural", $this->area);
                                    });
                                }
                            ]);
                    },

                    'ip_service_billings' => function ($q) use ($from, $to) {
                        $q->whereBetween('created_at', [$from, $to])
                            ->orderBy('created_at', $this->sorting_order)
                            ->with([
                                'billing_items',
                                'ipServiceDue',
                                'patient' => function ($q1) {
                                    $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                        $query->where("is_rural", $this->area);
                                    });
                                }
                            ]);
                    },

                    'registrations' => function ($q) use ($from, $to) {
                        $q->whereBetween('created_at', [$from, $to])
                            ->when($this->area == 0 || $this->area == 1, function ($query) {
                                $query->where("is_rural", $this->area);
                            })
                            ->orderBy('created_at', $this->sorting_order);
                    },

                    'patient_visits' => function ($q) use ($from, $to) {
                        $q->whereBetween('created_at', [$from, $to])
                            ->orderBy('created_at', $this->sorting_order)
                            ->with(['patient' => function ($q1) {
                                $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                    $query->where("is_rural", $this->area);
                                });
                            }]);
                    }
                ])
                    ->where(function ($query) use ($from, $to) {

                        // OPD Medicine
                        $query->whereHas('opd_medicine_receipts', function ($q) use ($from, $to) {
                            $q->whereHas('patient', function ($q1) {
                                $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                    $query->where("is_rural", $this->area);
                                });
                            })
                                ->where('is_cancled', 0)
                                ->whereBetween('created_at', [$from, $to])
                                ->when($this->patient_type, function ($q2) {
                                    $q2->where('patient_type', $this->patient_type);
                                });
                        })

                            // OP Bills
                            ->orWhereHas('opd_billings', function ($q) use ($from, $to) {
                                $q->whereHas('patient', function ($q1) {
                                    $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                        $query->where("is_rural", $this->area);
                                    });
                                })
                                    ->where('is_cancled', 0)
                                    ->whereBetween('created_at', [$from, $to])
                                    ->when($this->patient_type, function ($q2) {
                                        $q2->where('patient_type', $this->patient_type);
                                    });
                            })

                            // IP Pharmacy
                            ->orWhereHas('ip_pharmacy_indent_billings', function ($q) use ($from, $to) {
                                $q->whereHas('patient', function ($q1) {
                                    $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                        $query->where("is_rural", $this->area);
                                    });
                                })
                                    ->whereBetween('created_at', [$from, $to]);
                            })

                            // IP Service
                            ->orWhereHas('ip_service_billings', function ($q) use ($from, $to) {
                                $q->whereHas('patient', function ($q1) {
                                    $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                        $query->where("is_rural", $this->area);
                                    });
                                })
                                    ->whereBetween('created_at', [$from, $to]);
                            })

                            // Registrations
                            ->orWhereHas('registrations', function ($q) use ($from, $to) {
                                $q->whereBetween('created_at', [$from, $to])
                                    ->when($this->area == 0 || $this->area == 1, function ($query) {
                                        $query->where("is_rural", $this->area);
                                    });
                            })

                            // OP Consultation
                            ->orWhereHas('patient_visits', function ($q) use ($from, $to) {
                                $q->whereHas('patient', function ($q1) {
                                    $q1->when($this->area == 0 || $this->area == 1, function ($query) {
                                        $query->where("is_rural", $this->area);
                                    });
                                })
                                    ->whereBetween('created_at', [$from, $to]);
                            });
                    })
                    ->when($this->user_id, function ($query) {
                        $query->where('id', $this->user_id);
                    })
                    ->orderBy('name', $this->sorting_order)
                    ->get();

                $this->receipt_wise_shift_collections = $users;
                break;

            case 'service-group-wise':

                $service_group = ServiceGroup::with(['services' => function ($query) use ($from, $to) {
                    $query->where('isactive', 1)
                        ->with([
                            'opd_billing_items' => function ($q1) use ($from, $to) {
                                $q1->with(['opdBilling' =>  function ($q2) use ($from, $to) {
                                    $q2->with(['patient' => function ($q3) {
                                        $q3->when($this->area == 0 || $this->area == 1, function ($query) {
                                            $query->where("is_rural", $this->area);
                                        });
                                    }])
                                        ->where('is_cancled', 0)
                                        ->whereBetween('created_at', [$from, $to])
                                        ->when($this->patient_type, function ($q2) {
                                            $q2->where('patient_type', $this->patient_type);
                                        });
                                }])
                                    ->where('is_cancled', 0);
                            },
                            'ip_service_billing_items' => function ($q1) use ($from, $to) {
                                $q1->with(['ip_service_billing' => function ($q2) use ($from, $to) {
                                    $q2->with(['patient' => function ($q3) {
                                        $q3->when($this->area == 0 || $this->area == 1, function ($query) {
                                            $query->where("is_rural", $this->area);
                                        });
                                    }])
                                        ->whereBetween('created_at', [$from, $to])
                                        ->when($this->patient_type, function ($q2) {
                                            $q2->where('patient_type', $this->patient_type);
                                        });
                                }]);
                            }
                        ]);
                }])
                    ->whereHas('services', function ($query) use ($from, $to) {
                        $query->where('isactive', 1)
                            ->where(function ($subQuery) use ($from, $to) {
                                $subQuery->whereHas('opd_billing_items', function ($q1) use ($from, $to) {
                                    $q1->where('is_cancled', 0)
                                        ->whereHas('opdBilling', function ($q2) use ($from, $to) {
                                            $q2->whereHas('patient', function ($q3) {
                                                $q3->when($this->area == 0 || $this->area == 1, function ($query) {
                                                    $query->where("is_rural", $this->area);
                                                });
                                            })
                                                ->where('is_cancled', 0)
                                                ->whereBetween('created_at', [$from, $to])
                                                ->when($this->patient_type, function ($q2) {
                                                    $q2->where('patient_type', $this->patient_type);
                                                });;
                                        });
                                })
                                    ->orWhereHas('ip_service_billing_items', function ($q1) use ($from, $to) {
                                        $q1->whereHas('ip_service_billing', function ($q2) use ($from, $to) {
                                            $q2->whereHas('patient', function ($q3) {
                                                $q3->when($this->area == 0 || $this->area == 1, function ($query) {
                                                    $query->where("is_rural", $this->area);
                                                });
                                            })
                                                ->whereBetween('created_at', [$from, $to])
                                                ->when($this->patient_type, function ($q2) {
                                                    $q2->where('patient_type', $this->patient_type);
                                                });;
                                        });
                                    });
                            });
                    })
                    ->when($this->service_group_id, function ($query) {
                        $query->where('id', $this->service_group_id);
                    })
                    ->orderBy('name', $this->sorting_order)
                    ->get();

                $collections = [];

                foreach ($service_group as $group) {
                    $groupTotal = [
                        'qty' => 0,
                        'rate' => 0,
                        'amount' => 0,
                        'concession' => 0,
                        'receipt' => 0,
                        'due' => 0,
                    ];

                    foreach ($group->services as $service) {
                        $opdItems = $service->opd_billing_items ?? collect();
                        $ipItems = $service->ip_service_billing_items ?? collect();

                        if ($this->patient_type == "op" || $this->patient_type == "") {
                            foreach ($opdItems as $item) {
                                if (!$item->opdBilling || $item->opdBilling->is_cancled) continue;

                                $groupTotal['qty'] += $item->quantity;

                                $groupTotal['rate'] += $item->opdBilling->gross_amount;
                                $groupTotal['amount'] += $item->opdBilling->gross_amount;
                                $groupTotal['concession'] += $item->opdBilling->discount_amount;
                                $groupTotal['receipt'] += $item->opdBilling->paid_amount;

                                // due calculation with serviceDue check
                                $hasUnclearedDue = $item->opdBilling->serviceDue()
                                    ->where('is_due_cleared', 0)
                                    ->exists();

                                if ($hasUnclearedDue) {
                                    $groupTotal['due'] += $item->opdBilling->due_amount;
                                }
                            }
                        }

                        if ($this->patient_type == "ip" || $this->patient_type == "") {
                            foreach ($ipItems as $item) {
                                if (!$item->ip_service_billing) continue;

                                $groupTotal['qty'] += $item->quantity;

                                $groupTotal['rate'] += $item->ip_service_billing->gross_amount;
                                $groupTotal['amount'] += $item->ip_service_billing->gross_amount;
                                $groupTotal['concession'] += $item->ip_service_billing->discount_amount;
                                $groupTotal['receipt'] += $item->ip_service_billing->paid_amount;

                                // due calculation with ipServiceDue check
                                $hasUnclearedDue = $item->ip_service_billing->ipServiceDue()
                                    ->where('is_due_cleared', 0)
                                    ->exists();

                                if ($hasUnclearedDue) {
                                    $groupTotal['due'] += $item->ip_service_billing->due_amount;
                                }
                            }
                        }
                    }

                    $collections[] = [
                        'service_group' => $group->name,
                        'qty' => $groupTotal['qty'],
                        'rate' => $groupTotal['rate'],
                        'amount' => $groupTotal['amount'],
                        'concession' => $groupTotal['concession'],
                        'receipt' => $groupTotal['receipt'],
                        'due' => $groupTotal['due'],
                    ];
                }

                $this->receipt_wise_shift_collections = $collections;
                break;

            case 'service-type-wise':

                $opd = OpdBillingItems::with('service', 'opdBilling.serviceDue', 'opdBilling.patient')
                    ->select(
                        'services.type',
                        DB::raw('SUM(opd_billing_items.quantity) as total_qty'),
                        DB::raw('SUM(opd_billings.gross_amount) as total_gross'),
                        DB::raw('SUM(opd_billings.discount_amount) as total_discount'),
                        DB::raw('SUM(CASE WHEN (service_dues.is_due_cleared IS NULL OR service_dues.is_due_cleared = 0) THEN opd_billings.due_amount ELSE 0 END) as total_due'),
                        DB::raw('SUM(opd_billings.paid_amount) as total_paid')
                    )
                    ->join('opd_billings', 'opd_billings.id', '=', 'opd_billing_items.opd_billing_id')
                    ->join('services', 'services.id', '=', 'opd_billing_items.service_id')
                    ->leftJoin('service_dues', 'service_dues.opd_billing_id', '=', 'opd_billings.id')
                    ->where('opd_billing_items.is_cancled', 0)
                    ->when($this->patient_type, function ($query) {
                        $query->where('opd_billings.patient_type', $this->patient_type);
                    })
                    ->when($this->service_type_id, function ($query) {
                        $query->where('services.type', $this->service_type_id);
                    })
                    ->when($this->area == 0 || $this->area == 1, function ($query) {
                        $query->whereHas('opdBilling.patient', function ($q) {
                            $q->where("is_rural", $this->area);
                        });
                    })
                    ->whereBetween('opd_billing_items.created_at', [$from, $to])
                    ->orderBy('opd_billings.created_at', $this->sorting_order)
                    ->groupBy('services.type');

                // IP Query
                $ip = IpServiceBillingItem::with('service', 'ipServiceBilling.ipServiceDue')
                    ->select(
                        'services.type',
                        DB::raw('SUM(ip_service_billing_items.quantity) as total_qty'),
                        DB::raw('SUM(ip_service_billings.gross_amount) as total_gross'),
                        DB::raw('SUM(ip_service_billings.discount_amount) as total_discount'),
                        DB::raw('SUM(CASE WHEN (ip_service_dues.is_due_cleared IS NULL OR ip_service_dues.is_due_cleared = 0) THEN ip_service_billings.due_amount ELSE 0 END) as total_due'),
                        DB::raw('SUM(ip_service_billings.paid_amount) as total_paid')
                    )
                    ->join('ip_service_billings', 'ip_service_billings.id', '=', 'ip_service_billing_items.ip_service_billing_id')
                    ->join('services', 'services.id', '=', 'ip_service_billing_items.service_id')
                    ->leftJoin('ip_service_dues', 'ip_service_dues.ip_service_billing_id', '=', 'ip_service_billings.id')
                    ->when($this->patient_type, function ($query) {
                        $query->where('ip_service_billings.patient_type', $this->patient_type);
                    })
                    ->when($this->service_type_id, function ($query) {
                        $query->where('services.type', $this->service_type_id);
                    })
                    ->when($this->area == 0 || $this->area == 1, function ($query) {
                        $query->whereHas('ip_service_billings.patient', function ($q) {
                            $q->where("is_rural", $this->area);
                        });
                    })
                    ->whereBetween('ip_service_billing_items.created_at', [$from, $to])
                    ->orderBy('ip_service_billings.created_at', $this->sorting_order)
                    ->groupBy('services.type');

                // Merge + Final Group
                $service_type_wise = DB::query()
                    ->fromSub($opd->unionAll($ip), 'combined')
                    ->select(
                        'type',
                        DB::raw('SUM(total_qty) as total_qty'),
                        DB::raw('SUM(total_gross) as total_gross'),
                        DB::raw('SUM(total_discount) as total_discount'),
                        DB::raw('SUM(total_due) as total_due'),
                        DB::raw('SUM(total_paid) as total_paid')
                    )
                    ->groupBy('type')
                    ->get();

                $this->receipt_wise_shift_collections = $service_type_wise;
                break;

            case 'service-department-wise':

                $service_department_wise = Department::with([
                    'serviceGroups.services' => function ($q) use ($from, $to) {
                        $q->where('isactive', 1)
                            ->with([
                                'opd_billing_items' => function ($q1) use ($from, $to) {
                                    $q1->with(['opdBilling' =>  function ($q2) use ($from, $to) {
                                        $q2->with(['patient' => function ($q3) {
                                            $q3->when($this->area == 0 || $this->area == 1, function ($query) {
                                                $query->where("is_rural", $this->area);
                                            });
                                        }])
                                            ->where('is_cancled', 0)
                                            ->whereBetween('created_at', [$from, $to])
                                            ->when($this->patient_type, function ($q2) {
                                                $q2->where('patient_type', $this->patient_type);
                                            });
                                    }])
                                        ->where('is_cancled', 0);
                                },
                                'ip_service_billing_items' => function ($q1) use ($from, $to) {
                                    $q1->with(['ip_service_billing' => function ($q2) use ($from, $to) {
                                        $q2->with(['patient' => function ($q3) {
                                            $q3->when($this->area == 0 || $this->area == 1, function ($query) {
                                                $query->where("is_rural", $this->area);
                                            });
                                        }])
                                            ->whereBetween('created_at', [$from, $to])
                                            ->when($this->patient_type, function ($q2) {
                                                $q2->where('patient_type', $this->patient_type);
                                            });
                                    }]);
                                }
                            ]);
                    }
                ])
                    ->whereHas('serviceGroups.services', function ($query) use ($from, $to) {
                        $query->where('isactive', 1)
                            ->where(function ($subQuery) use ($from, $to) {
                                $subQuery->whereHas('opd_billing_items', function ($q1) use ($from, $to) {
                                    $q1->where('is_cancled', 0)
                                        ->whereHas('opdBilling', function ($q2) use ($from, $to) {
                                            $q2->whereHas('patient', function ($q3) {
                                                $q3->when($this->area == 0 || $this->area == 1, function ($query) {
                                                    $query->where("is_rural", $this->area);
                                                });
                                            })
                                                ->where('is_cancled', 0)
                                                ->whereBetween('created_at', [$from, $to])
                                                ->when($this->patient_type, function ($q2) {
                                                    $q2->where('patient_type', $this->patient_type);
                                                });;
                                        });
                                })
                                    ->orWhereHas('ip_service_billing_items', function ($q1) use ($from, $to) {
                                        $q1->whereHas('ip_service_billing', function ($q2) use ($from, $to) {
                                            $q2->whereHas('patient', function ($q3) {
                                                $q3->when($this->area == 0 || $this->area == 1, function ($query) {
                                                    $query->where("is_rural", $this->area);
                                                });
                                            })
                                                ->whereBetween('created_at', [$from, $to])
                                                ->when($this->patient_type, function ($q2) {
                                                    $q2->where('patient_type', $this->patient_type);
                                                });;
                                        });
                                    });
                            });
                    })
                    ->orderBy('name', $this->sorting_order)
                    ->get();

                $collections = [];

                foreach ($service_department_wise as $department) {
                    $departmentTotal = [
                        'qty' => 0,
                        'rate' => 0,
                        'amount' => 0,
                        'concession' => 0,
                        'receipt' => 0,
                        'due' => 0,
                    ];

                    foreach ($department->serviceGroups as $serviceGroup) {
                        foreach ($serviceGroup->services as $service) {
                            $opdItems = $service->opd_billing_items ?? collect();
                            $ipItems = $service->ip_service_billing_items ?? collect();

                            if ($this->patient_type == "op" || $this->patient_type == "") {
                                foreach ($opdItems as $item) {
                                    if (!$item->opdBilling || $item->opdBilling->is_cancled) continue;

                                    $departmentTotal['qty'] += $item->quantity;

                                    $departmentTotal['rate'] += $item->opdBilling->gross_amount;
                                    $departmentTotal['amount'] += $item->opdBilling->gross_amount;
                                    $departmentTotal['concession'] += $item->opdBilling->discount_amount;
                                    $departmentTotal['receipt'] += $item->opdBilling->paid_amount;

                                    // due calculation with serviceDue check
                                    $hasUnclearedDue = $item->opdBilling->serviceDue()
                                        ->where('is_due_cleared', 0)
                                        ->exists();

                                    if ($hasUnclearedDue) {
                                        $departmentTotal['due'] += $item->opdBilling->due_amount;
                                    }
                                }
                            }

                            if ($this->patient_type == "ip" || $this->patient_type == "") {
                                foreach ($ipItems as $item) {
                                    if (!$item->ip_service_billing) continue;

                                    $departmentTotal['qty'] += $item->quantity;

                                    $departmentTotal['rate'] += $item->ip_service_billing->gross_amount;
                                    $departmentTotal['amount'] += $item->ip_service_billing->gross_amount;
                                    $departmentTotal['concession'] += $item->ip_service_billing->discount_amount;
                                    $departmentTotal['receipt'] += $item->ip_service_billing->paid_amount;

                                    // due calculation with ipServiceDue check
                                    $hasUnclearedDue = $item->ip_service_billing->ipServiceDue()
                                        ->where('is_due_cleared', 0)
                                        ->exists();

                                    if ($hasUnclearedDue) {
                                        $departmentTotal['due'] += $item->ip_service_billing->due_amount;
                                    }
                                }
                            }
                        }
                    }

                    $collections[] = [
                        'department' => $department->name,
                        'qty' => $departmentTotal['qty'],
                        'rate' => $departmentTotal['rate'],
                        'amount' => $departmentTotal['amount'],
                        'concession' => $departmentTotal['concession'],
                        'receipt' => $departmentTotal['receipt'],
                        'due' => $departmentTotal['due'],
                    ];
                }

                $this->receipt_wise_shift_collections = $collections;

                break;

            case 'doctor-department-wise':

                break;
        }
    }

    public function exportPdf()
    {
        $this->show();

        if (count($this->receipt_wise_shift_collections) > 0) {
            $pdf = Pdf::loadView("exports.receipt-wise-shift-collection.$this->selection_type-report", [
                'from_date' => $this->from_date,
                'to_date' => $this->to_date,

                'search_type' => $this->search_type,
                'patient_type' => $this->patient_type,
                'receipt_wise_shift_collections' => $this->receipt_wise_shift_collections,

                'selection_types' => $this->selection_types,
                'selection_type' => $this->selection_type,
                'service_types' => $this->service_types,
            ])->setPaper('a4', 'landscape');

            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->stream();
            }, "$this->selection_type-report.pdf");
        }

        session()->flash('error', 'No result found...');
    }
}
