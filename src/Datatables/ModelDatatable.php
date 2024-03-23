<?php

namespace Fpaipl\Panel\Datatables;

use Illuminate\Support\Fluent;
use Illuminate\Support\Str;
use Fpaipl\Panel\Datatables\Datatable;

abstract class ModelDatatable implements Datatable
{
    /**
     * It is stored in log_name field of activity_log model.
     */
    const IMPORT_BATCH_LOG_NAME = 'Bulk Import';

    /**
     * Fluent class is a utility class provided by the Laravel framework that allows 
     * you to create and manipulate objects fluently. This means you can chain together 
     * method calls and property assignments in a more expressive and readable way 
     * without nesting long chains of method calls or using complex arrays
     */
    public function getfields(): Fluent
    {
        return new Fluent($this->getColumns());
    }
 
    /**
     * This will give list of features availabel on list/trash page,
     * such as search, Filter, Pagination, View,Edit, Delete, 
     * 'key_name' => [
     *      'show' => [ // This control button's visibility on PAGES based on array keys. i.e. active or trash.
     *          'active' => boolean, // true means visible and vice versa
     *          'trash' => boolean
     *      ],
     *      'label' => 'string', // Used as a label (optional)
     *      'type' => 'string',  // Name of component to be rendered
     *      'attributes' => 'string' // Its extra data whatever is required specificatlly for that component
     * ],
     */
    public function features(): array
    {
        return array(
            'search' => [
                'show' => [
                    'active' => true,
                    'trash' => true
                ],
                'label' => 'Search by name',
                'type' => 'forms.search-input',
                'attributes' => 'search',
            ],
            'column_filter' => [
                'show' => [
                    'active' => true,
                    'trash' => true
                ],
                'label' => 'Filter Fields',
                'type' => 'others.columns-filter',
                'attributes' => '',
            ],
            'bulk_actions' => [
                'show' => [
                    'active' => true,
                    'trash' => true,
                ],
                'labels' => [
                    'heading' => 'Bulk Select',
                    'options' => [
                        0 => [
                            'name' => 'Active Page',
                            'binding' => 'selectPage',
                        ],
                        1 => [
                            'name' => 'All Page',
                            'binding' => 'selectAll',
                        ]
                    ]
                ],
                'type' => 'buttons.bulk-select',
                'attributes' => '',
            ],
            'row_actions' => [
                'show' => [
                    'view' => [
                        'active' => true,
                        'trash' => true,
                    ],
                    'edit' => true,
                    'delete' => true,
                    'duplicate' => true,
                ],
                'label' => 'Actions',
                'type' => [
                    'buttons' => 'others.row-actions',
                    'collapse' => 'others.view-expanded'
                ],
                'attributes' => '',
            ],
            'pagination' => [
                'show' => [
                    'active' => true,
                    'trash' => true
                ],
                'label' => [
                    'pre' => 'Records',
                    'post' => 'per page',
                ],
                'type' => 'others.pagination',
                'attributes' => [
                    'options' => config('settings.per_page_count.options'),
                    'max' => config('settings.per_page_count.max'),
                ],
            ],
        );
    }

    /**
     * Here we provide the top buttons which comes on list page Import, DownloadSample.
    */ 
    public function topButtonsPart1(): array
    {
        return array(
            'import' => [
                'show' => [
                    'active' => true,
                    'trash' => false
                ],
                'label' => 'Import',
                'icon' => 'bi bi-upload',
                'type' => 'buttons.action-link',
                'style' => '',
                'route' => 'import-data.form',
                'function' => '',
            ],
            'download_sample' => [
                'show' => [
                    'active' => true,
                    'trash' => false,
                ],
                'label' => 'Download Sample',
                'icon' => 'bi bi-file-earmark-arrow-down',
                'type' => 'buttons.action-link',
                'style' => '',
                'route' => 'export-sample.model',
                'function' => '',
            ],
        );
    }

    /**
     * Here we provide the top buttons which comes on list page Export, BulkDelete, Trash.
     */

     public function topButtonsPart2(): array
     {
         return array(
             'export' => [
                 'show' => [
                     'active' => true,
                     'trash' => true
                 ],
                 'label' => 'Export',
                 'icon' => 'bi bi-download',
                 'type' => 'buttons.action-btn',
                 'style' => '',
                 'route' => false,
                 'function' => 'export',
             ],
             'bulk_delete' => [
                 'show' => [
                     'active' => $this->features()['bulk_actions']['show']['active'],
                     'trash' => false, // Will always be false because we can't delete on trash page.
                 ],
                 'label' => 'Bulk Delete',
                 'icon' => 'bi bi-trash3',
                 'type' => 'buttons.action-btn',
                 'style' => 'text-danger',
                 'route' => false,
                 'function' => 'deleteSelectedRecord',
             ],
             'bulk_restore' => [
                 'show' => [
                     'active' => false, // Will always be false because we can't restore on active page.
                     'trash' => $this->features()['bulk_actions']['show']['trash'],
                 ],
                 'label' => 'Bulk Restore',
                 'icon' => 'bi bi-arrow-counterclockwise',
                 'type' => 'buttons.action-btn',
                 'style' => 'text-success',
                 'route' => false,
                 'function' => 'restoreSelectedRecords',
             ],
             'trash' => [
                 'show' => [
                     'active' => true,
                     'trash' => false
                 ],
                 'label' => 'Trash',
                 'icon' => 'bi bi-recycle',
                 'type' => 'buttons.action-btn',
                 'style' => '',
                 'route' => false,
                 'function' => "toggleTrash('trash')",
             ],
             'active' => [
                 'show' => [
                     'active' => false,
                     'trash' => true
                 ],
                 'label' => 'Active',
                 'icon' => 'bi bi-x-lg',
                 'type' => 'buttons.action-btn',
                 'style' => '',
                 'route' => false,
                 'function' => "toggleTrash('active')",
             ],
         );
     }

    /**
     * This will give list of actions/links availabel on top of datatable,
     * such as Add, Import, Download Sample, Export, Bulk Delete, Bulk Restore, 
     * 'key_name' => [
     *      'show' => [ // This control button's visibility on pages based on array keys. i.e. active or trash.
     *          'active' => boolean, // true means visible and vice versa
     *          'trash' => boolean
     *      ],
     *      'label' => 'string', // Used as a label of button/Link/Toggle.
     *      'style' => 'mw-100px me-2', // Used as a classes string in button/link/toggle.
     *      // This value is used as component name used for crating this button/link/toggle.
     *      'type' => 'string',  // posible-values: action-btn, action-link, action-toggle
     *      'route' => 'string', // format(route.name), This value is Used as a route of link. it is required with action-link
     *      'function' => 'string', // function name which is called when we click on this button, required with action-btn
     *      
     * ],
     */
    public function buttons($position): array
    {
        switch ($position) {
            case 'top': return $this->topButtons();
            case 'table': return $this->tableButtons();
            default: return array();
        }
    }

    /**
    * Here we provide all those table fields detail that comes before specific model related table fields.
    */
    public function getDefaultPreColumns(): array
    {
        return array(
            'serial' => [
                'name' => 'serial',
                'labels' => [
                    'table' => '#',
                    'export' => 'S. No.'
                ],
                'viewable' => [
                    'active' => true,
                    'trash' => true
                ],
                'expandable' => [
                    'active' => false,
                    'trash' => false
                ],
                'sortable' => false,
                'thead' => [
                    'view' => 'buttons.sortit',
                    'value' => '',
                    'align' => '',
                ],
                'tbody' => [
                    'view' => 'cells.serial-count',
                    'value' => 'getTableRowId',
                    'align' => '',
                ],
                'importable' => false,
                'exportable' => [
                    'active' => false,
                    'trash' => false,
                    'value' => 'getExportData'
                ],
                'artificial' => true,
                'filterable' => [
                    'active' => true,
                    'trash' => true
                ],


            ]           
        );
    }

    /**
     * Here we provide all those table fields detail that comes after specific model related table fields.
     */
    public function getDefaultPostColumns(): array
    {
        return array(
            'created_at' => [
                'name' => 'created_at',
                'labels' => [
                    'table' => 'Created At',
                    'export' => 'Created At'
                ],
                'viewable' => [
                    'active' => false,
                    'trash' => false
                ],
                'expandable' => [
                    'active' => false,
                    'trash' => true
                ],
                'sortable' => true,
                'thead' => [
                    'view' => 'buttons.sortit',
                    'value' => '',
                    'align' => '',
                ],
                'tbody' => [
                    'view' => 'cells.date-value',
                    'value' => 'getTableData',
                    'align' => '',
                ],
                'importable' => false,
                'exportable' => [
                    'active' => true,
                    'trash' => true,
                    'value' => 'getExportData'
                ],
                'filterable' => [
                    'active' => true,
                    'trash' => false
                ],
                'artificial' => true,


            ],
            'updated_at' => [
                'name' => 'updated_at',
                'labels' => [
                    'table' => 'Updated At',
                    'export' => 'Updated At'
                ],
                'viewable' => [
                    'active' => false,
                    'trash' => false
                ],
                'expandable' => [
                    'active' => false,
                    'trash' => true
                ],
                'sortable' => true,
                'thead' => [
                    'view' => 'buttons.sortit',
                    'value' => '',
                    'align' => '',
                ],
                'tbody' => [
                    'view' => 'cells.date-value',
                    'value' => 'getTableData',
                    'align' => '',
                ],
                'importable' => false,
                'exportable' => [
                    'active' => true,
                    'trash' => false,
                    'value' => 'getExportData'
                ],
                'filterable' => [
                    'active' => true,
                    'trash' => false
                ],
                'artificial' => true,

            ],
            'deleted_at' => [
                'name' => 'deleted_at',
                'labels' => [
                    'table' => 'Deleted At',
                    'export' => 'Deleted At'
                ],
                'viewable' => [
                    'active' => false,
                    'trash' => false
                ],
                'expandable' => [
                    'active' => false, // will always be false
                    'trash' => false
                ],
                'sortable' => true,
                'thead' => [
                    'view' => 'buttons.sortit',
                    'value' => '',
                    'align' => '',
                ],
                'tbody' => [
                    'view' => 'cells.date-value',
                    'value' => 'getTableData',
                    'align' => '',
                ],
                'importable' => false,
                'exportable' => [
                    'active' => false,
                    'trash' => true,
                    'value' => 'getExportData'
                ],
                'filterable' => [
                    'active' => false,
                    'trash' => true
                ],
                'artificial' => true,


            ]
        );
    }

    /**
    * Here we provide the slug column
    */

    public function getDefaultSlugColumns(): array
    {
        return array(
            'slug' => [
                'name' => 'slug',
                'labels' => [
                    'table' => 'Slug',
                    'export' => 'Slug'
                ],

                'thead' => [
                    'view' => 'buttons.sortit',
                    'value' => '',
                    'align' => '',
                ],
                'tbody' => [
                    'view' => 'cells.text-value',
                    'value' => '',
                    'align' => 'getTableData',
                ],
                'viewable' => [
                    'active' => false,
                    'trash' => false
                ],
                'importable' => false,
                'expandable' => [
                    'active' => true,
                    'trash' => false
                ],
                'sortable' => false,
                'filterable' => [
                    'active' => true,
                    'trash' => false
                ],
                'exportable' => [
                    'active' => true,
                    'trash' => false,
                    'value' => 'getExportData'
                ],
                'artificial' => true,


            ],
        );
    }

    /**
    * Here we provide single image detail.
    */
    public function getDefaultImageColumn(): array
    {
        return array(
            'image' => [
                'name' => 'image',
                'labels' => [
                    'table' => 'Image',
                    'export' => 'Image'
                ],
        
                'thead' => [
                    'view' => 'buttons.sortit',
                    'value' => '',
                    'align' => 'center',
                ],
                'tbody' => [
                    'view' => 'cells.image-value',
                    'value' => '',
                    'align' => '',
                ],
                'viewable' => [
                    'active' => true,
                    'trash' => true
                ],
                'importable' => false,
                'expandable' => [
                    'active' => false,
                    'trash' => false
                ],
                'sortable' => false,
                'filterable' => [
                    'active' => true,
                    'trash' => true
                ],
                'exportable' => [
                    'active' => false,
                    'trash' => false,
                    'value' => 'getExportData'
                ],
                'artificial' => false,
                'fillable' => [
                    'type' => 'file',
                    'style' => '',
                    'placeholder' => '',
                    'component' => 'forms.upload-file',
                    'attributes' => ['required'],
                    'rows' => ''
                ],
        
            ],
        );
    }

    /**
    * Here we provide multiple images detail.
    */
    public function getDefaultImagesColumn(): array
    {
        return array(
            'images' => [
                'name' => 'images',
                'labels' => [
                    'table' => 'Images',
                    'export' => 'Images'
                ],
        
                'thead' => [
                    'view' => 'buttons.sortit',
                    'value' => '',
                    'align' => '',
                ],
                'tbody' => [
                    'view' => 'cells.images-value',
                    'value' => 'getTableData',
                    'align' => '',
                ],
                'viewable' => [
                    'active' => false,
                    'trash' => false
                ],
                'expandable' => [
                    'active' => true,
                    'trash' => true
                ],
                'sortable' => false,
                'filterable' => [
                    'active' => false,
                    'trash' => false
                ],
                'importable' => false,
                'exportable' => [
                    'active' => false,
                    'trash' => false,
                    'value' => 'getExportData'
                ],
                'artificial' => false,
                'fillable' => [
                    'type' => 'file',
                    'placeholder' => '',
                    'style' => '',
                    'component' => 'forms.upload-file',
                    'attributes' => ['multiple'],
                    'rows' => ''
                ],
        
        
            ],
        );
    }

    /**
    * Here we provide all the page & validation messages.
    */
    public function getMessages(): array
    {
        return array(

            'list_page' => "{$this->getModelName('class')} List",

            'show_page' => "{$this->getModelName('title')}",

            'create_page' => "Create {$this->getModelName('title')}",

            'edit_page' => "Edit {$this->getModelName('title')}",

            'advance_delete_page' => "Delete {$this->getModelName('title')}",

            'import_page' => "{$this->getModelName('title')} Import",

            'create_success' => "{$this->getModelName('title')} has been created successfully.",

            'edit_success' => "{$this->getModelName('title')} has been updated successfully.",

            'delete_success' => "{$this->getModelName('title')}  has been deleted successfully.",

            'restore_success' => "{$this->getModelName('title')}  has been restored successfully.",

            'import_success' => 'File has been imported successfully.',

            'has_dependency' => 'One or more record has dependent records so you are unable to delete the records.',

            'create_error' => "Unable to create {$this->getModelName()}, try again.",

            'edit_error' => "Unable to update {$this->getModelName()}, try again.",

            'delete_error' => "Unable to delete {$this->getModelName()}, try again.",

            'validation_msg' => "Please, checked delete type.",

            'image_delete' => "Check Image For Delete",

            'no_record_found' => "No data available to show.",

            'under_dev'=> "Oops! Panel Under Development"

        );

    }

    /**
     * It is used for generating the filename of excel file in exporting the data.
     */
    public function filename(): string
    {
        return config('app.name') ."_". Str::of($this->getModelName())->plural() ."_". date('YmdHis') . '.xlsx';
    }

     /**
     * It gives the model name used for generating the unique id of input field.
     */
    // public function getModelName($type = null): string
    // {
    //     //It is used for creating id of input fields
    //     $modelName = Str::remove('datatable', Str::of(Str::afterLast(get_class($this), '\\'))->lower());
    //     switch ($type) {
    //         case 'title': return Str::of($modelName)->title();
    //         case 'studly': return Str::of($modelName)->studly();
    //         default /*lower*/: return Str::of($modelName);
    //     }
    // }

    public function getModelName($type = null): string
    {
        //It is used for creating id of input fields
        $modelName = Str::remove('Datatable', Str::afterLast(get_class($this), '\\'));
        
        switch ($type) {
            case 'class': return Str::of($modelName);
            case 'title': return Str::of($modelName)->title();
            case 'studly': return Str::of($modelName)->studly();
            default /*lower*/: return Str::of($modelName)->lower();
        }
    }
}

/**
 * Templates
 */

/*
    1. 
    
    'name' => [
        'show' => [
            'active' => true,
            'trash' => false
        ],
        'label' => 'Name',
        'type' => 'buttons(blade-view)',
        'style' => 'mw-100px me-2',
        'route' => '',
        'function' => '',
    ],

 */
