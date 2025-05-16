<?php
namespace App\Traits\Seed;

use App\Models\PermissionGroup;
use App\Models\Permission;
use Illuminate\Support\Str;
use DB;

trait PermissionTrait
{
    /**
     * seedAndCheckPermission function
     * seed permissions and check existing permission
     * @return void
     */
    public function seedAndCheckPermission()
    {

        // start user management

        //  permission group table

        // fecen4 Role

        $g = (new PermissionGroup())->where('name', 'fecen9')->first();
        if (!$g) {
            $g = PermissionGroup::create([
                'name' => 'fecen9',
                'category' => 'admin',
            ]);
        }
        //  permission  table
        $permissions = [
            [
                'name' => 'fecen9_list'
            ],
            [
                'name' => 'fecen9_create'
            ],
            [
                'name' => 'fecen9_edit'
            ],
            [
                'name' => 'fecen9_view'
            ],
            [
                'name' => 'fecen9_delete'
            ],
            [
                'name' => 'fecen9_report'
            ],
            [
                'name' => 'fecen9_print'
            ],
            [
                'name' => 'fecen9_download'
            ],
            [
                'name' => 'fecen9_upload'
            ],
            [
                'name' => 'fecen9_send_for_approval'
            ],
            [
                'name' => 'fecen9_approve'
            ],
            [
                'name' => 'fecen9_reject'
            ],
            [
                'name' => 'fecen9_send_for_edit'
            ]


        ];
        foreach ($permissions as $key => $value) {
            $p = (new Permission())->where('name', $value)->first();
            if (!$p) {
                $p = Permission::create($value);
                $g->permissions()->attach($p->id, ['id' => Str::uuid()->toString()]);

            }
        }
        // fecen5 permission
        $g = (new PermissionGroup())->where('name', 'fecen5')->first();
        if (!$g) {
            $g = PermissionGroup::create([
                'name' => 'fecen5',
                'category' => 'admin',
            ]);
        }
        //  permission  table
        $permissions = [
            [
                'name' => 'fecen5_list'
            ],
            [
                'name' => 'fecen5_create'
            ],
            [
                'name' => 'fecen5_edit'
            ],
            [
                'name' => 'fecen5_view'
            ],
            [
                'name' => 'fecen5_delete'
            ],
            [
                'name' => 'fecen5_report'
            ],
            [
                'name' => 'fecen5_print'
            ],
            [
                'name' => 'fecen5_download'
            ],
            [
                'name' => 'fecen5_upload'
            ],
            [
                'name' => 'fecen5_send_for_approval'
            ],
            [
                'name' => 'fecen5_approve'
            ],
            [
                'name' => 'fecen5_reject'
            ],
            [
                'name' => 'fecen5_send_for_edit'
            ]


        ];
        foreach ($permissions as $key => $value) {
            $p = (new Permission())->where('name', $value)->first();
            if (!$p) {
                $p = Permission::create($value);
                $g->permissions()->attach($p->id, ['id' => Str::uuid()->toString()]);

            }
        }
        // meme7 permission
        $g = (new PermissionGroup())->where('name', 'meem7')->first();
        if (!$g) {
            $g = PermissionGroup::create([
                'name' => 'meem7',
                'category' => 'admin',
            ]);
        }
        //  permission  table
        $permissions = [
            [
                'name' => 'meem7_list'
            ],
            [
                'name' => 'meem7_create'
            ],
            [
                'name' => 'meem7_edit'
            ],
            [
                'name' => 'meem7_view'
            ],
            [
                'name' => 'meem7_delete'
            ],
            [
                'name' => 'meem7_report'
            ],
            [
                'name' => 'meem7_print'
            ],
            [
                'name' => 'meem7_download'
            ],
            [
                'name' => 'meem7_upload'
            ],
            [
                'name' => 'meem7_send_for_approval'
            ],
            [
                'name' => 'meem7_approve'
            ],
            [
                'name' => 'meem7_reject'
            ],
            [
                'name' => 'meem7_send_for_edit'
            ]


        ];
        foreach ($permissions as $key => $value) {
            $p = (new Permission())->where('name', $value)->first();
            if (!$p) {
                $p = Permission::create($value);
                $g->permissions()->attach($p->id, ['id' => Str::uuid()->toString()]);

            }
        }
        //end


        //fecen8

        $g = (new PermissionGroup())->where('name', 'fecen8')->first();
        if (!$g) {
            $g = PermissionGroup::create([
                'name' => 'fecen8',
                'category' => 'admin',
            ]);
        }
        //  permission  table
        $permissions = [
            [
                'name' => 'fecen8_list'
            ],
            [
                'name' => 'fecen8_create'
            ],
            [
                'name' => 'fecen8_edit'
            ],
            [
                'name' => 'fecen8_view'
            ],
            [
                'name' => 'fecen8_delete'
            ],
            [
                'name' => 'fecen8_report'
            ],
            [
                'name' => 'fecen8_print'
            ],
            [
                'name' => 'fecen8_download'
            ],
            [
                'name' => 'fecen8_upload'
            ],
            [
                'name' => 'fecen8_send_for_approval'
            ],
            [
                'name' => 'fecen8_approve'
            ],
            [
                'name' => 'fecen8_reject'
            ],
            [
                'name' => 'fecen8_send_for_edit'
            ]


        ];
        foreach ($permissions as $key => $value) {
            $p = (new Permission())->where('name', $value)->first();
            if (!$p) {
                $p = Permission::create($value);
                $g->permissions()->attach($p->id, ['id' => Str::uuid()->toString()]);

            }
        }
        //end fecen8
        //card_to_card

        $g = (new PermissionGroup())->where('name', 'card_to_card')->first();
        if (!$g) {
            $g = PermissionGroup::create([
                'name' => 'card_to_card',
                'category' => 'admin',
            ]);
        }
        //  permission  table
        $permissions = [
            [
                'name' => 'card_to_card_list'
            ],
            [
                'name' => 'card_to_card_create'
            ],
            [
                'name' => 'card_to_card_edit'
            ],
            [
                'name' => 'card_to_card_view'
            ],
            [
                'name' => 'card_to_card_delete'
            ],
            [
                'name' => 'card_to_card_report'
            ],
            [
                'name' => 'card_to_card_print'
            ],
            [
                'name' => 'card_to_card_download'
            ],
            [
                'name' => 'card_to_card_upload'
            ],
            [
                'name' => 'card_to_card_send_for_approval'
            ],
            [
                'name' => 'card_to_card_approve'
            ],
            [
                'name' => 'card_to_card_reject'
            ],
            [
                'name' => 'card_to_card_send_for_edit'
            ]


        ];
        foreach ($permissions as $key => $value) {
            $p = (new Permission())->where('name', $value)->first();
            if (!$p) {
                $p = Permission::create($value);
                $g->permissions()->attach($p->id, ['id' => Str::uuid()->toString()]);

            }
        }
        //end card_to_card
        //fecen1

        $g = (new PermissionGroup())->where('name', 'fecen1')->first();
        if (!$g) {
            $g = PermissionGroup::create([
                'name' => 'fecen1',
                'category' => 'admin',
            ]);
        }
        //  permission  table
        $permissions = [
            [
                'name' => 'fecen1_list'
            ],
            [
                'name' => 'fecen1_create'
            ],
            [
                'name' => 'fecen1_edit'
            ],
            [
                'name' => 'fecen1_view'
            ],
            [
                'name' => 'fecen1_delete'
            ],
            [
                'name' => 'fecen1_report'
            ],
            [
                'name' => 'fecen1_print'
            ],
            [
                'name' => 'fecen1_download'
            ],
            [
                'name' => 'fecen1_upload'
            ],
            [
                'name' => 'fecen1_send_for_approval'
            ],
            [
                'name' => 'fecen1_approve'
            ],
            [
                'name' => 'fecen1_reject'
            ],
            [
                'name' => 'fecen1_send_for_edit'
            ]


        ];
        foreach ($permissions as $key => $value) {
            $p = (new Permission())->where('name', $value)->first();
            if (!$p) {
                $p = Permission::create($value);
                $g->permissions()->attach($p->id, ['id' => Str::uuid()->toString()]);

            }
        }
        //end fecen1
        //fecen4

        $g = (new PermissionGroup())->where('name', 'fecen4')->first();
        if (!$g) {
            $g = PermissionGroup::create([
                'name' => 'fecen4',
                'category' => 'admin',
            ]);
        }
        //  permission  table
        $permissions = [
            [
                'name' => 'fecen4_list'
            ],
            [
                'name' => 'fecen4_create'
            ],
            [
                'name' => 'fecen4_edit'
            ],
            [
                'name' => 'fecen4_view'
            ],
            [
                'name' => 'fecen4_delete'
            ],
            [
                'name' => 'fecen4_report'
            ],
            [
                'name' => 'fecen4_print'
            ],
            [
                'name' => 'fecen4_download'
            ],
            [
                'name' => 'fecen4_upload'
            ],
            [
                'name' => 'fecen4_send_for_approval'
            ],
            [
                'name' => 'fecen4_approve'
            ],
            [
                'name' => 'fecen4_reject'
            ],
            [
                'name' => 'fecen4_send_for_edit'
            ]


        ];
        foreach ($permissions as $key => $value) {
            $p = (new Permission())->where('name', $value)->first();
            if (!$p) {
                $p = Permission::create($value);
                $g->permissions()->attach($p->id, ['id' => Str::uuid()->toString()]);

            }
        }
        //end fecen4
        //settings

        $g = (new PermissionGroup())->where('name', 'setting')->first();
        if (!$g) {
            $g = PermissionGroup::create([
                'name' => 'setting',
                'category' => 'admin',
            ]);
        }
        //  permission  table
        $permissions = [
            [
                'name' => 'setting_list'
            ],
            [
                'name' => 'setting_create'
            ],
            [
                'name' => 'setting_edit'
            ],
            [
                'name' => 'setting_view'
            ],
            [
                'name' => 'setting_delete'
            ],
            [
                'name' => 'setting_report'
            ],
            [
                'name' => 'setting_print'
            ],
            [
                'name' => 'setting_download'
            ],
            [
                'name' => 'setting_upload'
            ]


        ];
        foreach ($permissions as $key => $value) {
            $p = (new Permission())->where('name', $value)->first();
            if (!$p) {
                $p = Permission::create($value);
                $g->permissions()->attach($p->id, ['id' => Str::uuid()->toString()]);

            }
        }

        $g = (new PermissionGroup())->where('name', 'other_permission')->first();
        if (!$g) {
            $g = PermissionGroup::create([
                'name' => 'other_permission',
                'category' => 'admin',
            ]);
        }
        //  permission  table
        $permissions = [
            [
                'name' => 'item_onhand'
            ],
            [
                'name' => 'storage_card_list'
            ],
            [
                'name' => 'ownership_card_list'
            ],
        ];
        foreach ($permissions as $key => $value) {
            $p = (new Permission())->where('name', $value)->first();
            if (!$p) {
                $p = Permission::create($value);
                $g->permissions()->attach($p->id, ['id' => Str::uuid()->toString()]);

            }
        }
        $g = (new PermissionGroup())->where('name', 'user')->first();
        if (!$g) {
            $g = PermissionGroup::create([
                'name' => 'user',
                'category' => 'admin',
            ]);
        }
        //  permission  table
        $permissions = [
            [
                'name' => 'user_list'
            ],
            [
                'name' => 'user_create'
            ],
            [
                'name' => 'user_edit'
            ],
            [
                'name' => 'user_view'
            ],
            [
                'name' => 'user_delete'
            ],


        ];
        foreach ($permissions as $key => $value) {
            $p = (new Permission())->where('name', $value)->first();
            if (!$p) {
                $p = Permission::create($value);
                $g->permissions()->attach($p->id, ['id' => Str::uuid()->toString()]);

            }
        }
        //end
        //  permission group table

        $g = (new PermissionGroup())->where('name', 'role')->first();
        if (!$g) {
            $g = PermissionGroup::create([
                'name' => 'role',
                'category' => 'admin',
            ]);
        }
        //  permission  table
        $permissions = [
            [
                'name' => 'role_list'
            ],
            [
                'name' => 'role_create'
            ],
            [
                'name' => 'role_edit'
            ],
            [
                'name' => 'role_view'
            ],
            [
                'name' => 'role_delete'
            ],



        ];
        foreach ($permissions as $key => $value) {
            $p = (new Permission())->where('name', $value)->first();
            if (!$p) {
                $p = Permission::create($value);
                $g->permissions()->attach($p->id, ['id' => Str::uuid()->toString()]);

            }
        }
        //end settings
//        Sejel permissions
        $g = (new PermissionGroup())->where('name', 'sejel')->first();
        if (!$g) {
            $g = PermissionGroup::create([
                'name' => 'sejel',
                'category' => 'admin',
            ]);
        }
        //  permission  table
        $permissions = [
            [
                'name' => 'sejel_list'
            ],
            [
                'name' => 'sejel_create'
            ],
            [
                'name' => 'sejel_edit'
            ],
            [
                'name' => 'sejel_view'
            ],
            [
                'name' => 'sejel_delete'
            ],
            [
                'name' => 'sejel_report'
            ],
            [
                'name' => 'sejel_print'
            ],
            [
                'name' => 'sejel_download'
            ],
            [
                'name' => 'sejel_upload'
            ],
            [
                'name' => 'sejel_send_for_approval'
            ],
            [
                'name' => 'sejel_approve'
            ],
            [
                'name' => 'sejel_reject'
            ],
            [
                'name' => 'sejel_send_for_edit'
            ]
        ];
        foreach ($permissions as $key => $value) {
            $p = (new Permission())->where('name', $value)->first();
            if (!$p) {
                $p = Permission::create($value);
                $g->permissions()->attach($p->id, ['id' => Str::uuid()->toString()]);
            }
        }
        //        moblin permissions
        $g = (new PermissionGroup())->where('name', 'moblin')->first();
        if (!$g) {
            $g = PermissionGroup::create([
                'name' => 'moblin',
                'category' => 'admin',
            ]);
        }
        //  permission  table
        $permissions = [
            [
                'name' => 'moblin_list'
            ],
            [
                'name' => 'moblin_create'
            ],
            [
                'name' => 'moblin_edit'
            ],
            [
                'name' => 'moblin_view'
            ],
            [
                'name' => 'moblin_delete'
            ],
            [
                'name' => 'moblin_report'
            ],
            [
                'name' => 'moblin_print'
            ],
            [
                'name' => 'moblin_download'
            ],
            [
                'name' => 'moblin_upload'
            ],
            [
                'name' => 'moblin_send_for_approval'
            ],
            [
                'name' => 'moblin_approve'
            ],
            [
                'name' => 'moblin_reject'
            ],
            [
                'name' => 'moblin_send_for_edit'
            ]
        ];
        foreach ($permissions as $key => $value) {
            $p = (new Permission())->where('name', $value)->first();
            if (!$p) {
                $p = Permission::create($value);
                $g->permissions()->attach($p->id, ['id' => Str::uuid()->toString()]);
            }
        }

        //        repairing permissions
        $g = (new PermissionGroup())->where('name', 'repairing')->first();
        if (!$g) {
            $g = PermissionGroup::create([
                'name' => 'repairing',
                'category' => 'admin',
            ]);
        }
        //  permission  table
        $permissions = [
            [
                'name' => 'repairing_list'
            ],
            [
                'name' => 'repairing_create'
            ],
            [
                'name' => 'repairing_edit'
            ],
            [
                'name' => 'repairing_view'
            ],
            [
                'name' => 'repairing_delete'
            ],
            [
                'name' => 'repairing_report'
            ],
            [
                'name' => 'repairing_print'
            ],
            [
                'name' => 'repairing_download'
            ],
            [
                'name' => 'repairing_upload'
            ],
            [
                'name' => 'repairing_send_for_approval'
            ],
            [
                'name' => 'repairing_approve'
            ],
            [
                'name' => 'repairing_reject'
            ],
            [
                'name' => 'repairing_send_for_edit'
            ]
        ];
        foreach ($permissions as $key => $value) {
            $p = (new Permission())->where('name', $value)->first();
            if (!$p) {
                $p = Permission::create($value);
                $g->permissions()->attach($p->id, ['id' => Str::uuid()->toString()]);
            }
        }

        //        oil_fc9 permissions
        $g = (new PermissionGroup())->where('name', 'oil_fc9')->first();
        if (!$g) {
            $g = PermissionGroup::create([
                'name' => 'oil_fc9',
                'category' => 'admin',
            ]);
        }
        //  permission  table
        $permissions = [
            [
                'name' => 'oil_fc9_list'
            ],
            [
                'name' => 'oil_fc9_create'
            ],
            [
                'name' => 'oil_fc9_edit'
            ],
            [
                'name' => 'oil_fc9_view'
            ],
            [
                'name' => 'oil_fc9_delete'
            ],

        ];
        foreach ($permissions as $key => $value) {
            $p = (new Permission())->where('name', $value)->first();
            if (!$p) {
                $p = Permission::create($value);
                $g->permissions()->attach($p->id, ['id' => Str::uuid()->toString()]);
            }
        }

        //        dashboard permissions
        $g = (new PermissionGroup())->where('name', 'dashboard')->first();
        if (!$g) {
            $g = PermissionGroup::create([
                'name' => 'dashboard',
                'category' => 'admin',
            ]);
        }
        //  permission  table
        $permissions = [
            [
                'name' => 'fecen1_dashboard_widget'
            ],
            [
                'name' => 'fecen4_dashboard_widget'
            ],
            [
                'name' => 'fecen5_dashboard_widget'
            ],
            [
                'name' => 'fecen8_dashboard_widget'
            ],
            [
                'name' => 'fecen9_dashboard_widget'
            ],
            [
                'name' => 'meem7_dashboard_widget'
            ],
            [
                'name' => 'moblin_dashboard_widget'
            ],
            [
                'name' => 'repairing_dashboard_widget'
            ],
            [
                'name' => 'sejel_dashboard_widget'
            ],
            [
                'name' => 'oil_fc9_dashboard_widget'
            ],
            [
                'name' => 'progress_chart'
            ],
            [
                'name' => 'distribution_items'
            ],
            [
                'name' => 'consuming_items_in_fiscal_year_chart'
            ],
            [
                'name' => 'vehicle_expenditure'
            ],

        ];
        foreach ($permissions as $key => $value) {
            $p = (new Permission())->where('name', $value)->first();
            if (!$p) {
                $p = Permission::create($value);
                $g->permissions()->attach($p->id, ['id' => Str::uuid()->toString()]);
            }
        }
        //        Report permissions
        $g = (new PermissionGroup())->where('name', 'Report')->first();
        if (!$g) {
            $g = PermissionGroup::create([
                'name' => 'report',
                'category' => 'admin',
            ]);
        }
        //  permission  table
        $permissions = [
            [
                'name' => 'item_general_report'
            ],
            [
                'name' => 'distributed_items'
            ],
            [
                'name' => 'depreciation_item_history'
            ],
            [
                'name' => 'vehicle_expenses'
            ],
            [
                'name' => 'reports_list'
            ],

        ];
        foreach ($permissions as $key => $value) {
            $p = (new Permission())->where('name', $value)->first();
            if (!$p) {
                $p = Permission::create($value);
                $g->permissions()->attach($p->id, ['id' => Str::uuid()->toString()]);
            }
        }

        //        application Logs permissions
        $g = (new PermissionGroup())->where('name', 'application_log')->first();
        if (!$g) {
            $g = PermissionGroup::create([
                'name' => 'application_log',
                'category' => 'admin',
            ]);
        }
        //  permission  table
        $permissions = [
            [
                'name' => 'application_log_list'
            ],
            [
                'name' => 'application_log_view'
            ],
        ];
        foreach ($permissions as $key => $value) {
            $p = (new Permission())->where('name', $value)->first();
            if (!$p) {
                $p = Permission::create($value);
                $g->permissions()->attach($p->id, ['id' => Str::uuid()->toString()]);
            }
        }

        //        Driver expenditure permissions
        $g = (new PermissionGroup())->where('name', 'driver_expenditure_form')->first();
        if (!$g) {
            $g = PermissionGroup::create([
                'name' => 'driver_expenditure_form',
                'category' => 'admin',
            ]);
        }
        //  permission  table
        $permissions = [
            [
                'name' => 'driver_expenditure_form_list'
            ],
            [
                'name' => 'driver_expenditure_form_create'
            ],

        ];
        foreach ($permissions as $key => $value) {
            $p = (new Permission())->where('name', $value)->first();
            if (!$p) {
                $p = Permission::create($value);
                $g->permissions()->attach($p->id, ['id' => Str::uuid()->toString()]);
            }
        }

    }
}

?>
