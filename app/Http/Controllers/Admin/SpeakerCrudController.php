<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SpeakerRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SpeakerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SpeakerCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Speaker::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/speaker');
        CRUD::setEntityNameStrings('speaker', 'speakers');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        //CRUD::setFromDb(); // columns
        CRUD::addColumn(
            [
                'name' => 'name',
                'type' => 'text'
            ]
        );
        CRUD::addColumn(
            [
                'name' => 'position',
                'type' => 'text'
            ]
        );
        CRUD::addColumn(
            [
                'name' => 'description',
                'type' => 'text'
            ]
        );
        CRUD::addColumn(
            [
                'name'      => 'image', // The db column name
                'label'     => 'Image', // Table column heading
                'type'      => 'image'
            ]
        );
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(SpeakerRequest::class);

        //CRUD::setFromDb(); // fields
        CRUD::addField([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Name'
        ]);
        CRUD::addField([
            'name' => 'position',
            'type' => 'text',
            'label' => 'Position'
        ]);
        CRUD::addField([
            'name' => 'description',
            'type' => 'textarea',
            'label' => 'Description'
        ]);
        CRUD::addField(
            [   // Upload
                'name'      => 'image',
                'label'     => 'Speaker Image',
                'type'      => 'upload',
                'upload'    => true,
            ]
        );
        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
