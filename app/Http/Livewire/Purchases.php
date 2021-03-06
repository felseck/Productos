<?php

namespace App\Http\Livewire;
use App\Models\Purchase;
use Livewire\WithPagination;

use Livewire\Component;

class Purchases extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    public $model = 'Purchase';
    public $pageTitle = 'Purchases';

	public $fieldsOptions = [
        [
            'field'=>'id',
            'label'=>'Id',
            'locale_label'=>false,
            'editable'=>false,
            'creatable'=>false,
            'show'=>true,
            'thClass'=>'',
            'valueClass'=>'',
            'filter'=>true
        ],


        [
            'field'=>'product_name',
            'label'=>'Name',
            'locale_label'=>true,
            'editable'=>true,
            'creatable'=>true,
            'show'=>true,
            'thClass'=>'',
            'valueClass'=>'',
            'filter'=>true
        ],
      

        [
            'field'=>'price',
            'label'=>'price',
            'locale_label'=>true,
            'editable'=>true,
            'creatable'=>true,
            'show'=>true,
            'thClass'=>'',
            'valueClass'=>'',
            'filter'=>true
        ],

        [
            'field'=>'tax',
            'label'=>'Tax %',
            'locale_label'=>true,
            'editable'=>true,
            'creatable'=>true,
            'show'=>true,
            'thClass'=>'',
            'valueClass'=>'',
            'filter'=>true
        ],

        [
            'field'=>'total_tax',
            'label'=>'Total Tax',
            'locale_label'=>true,
            'editable'=>true,
            'creatable'=>true,
            'show'=>true,
            'thClass'=>'',
            'valueClass'=>'',
            'filter'=>true
        ],

        [
            'field'=>'user_id',
            'label'=>'User Id',
            'locale_label'=>true,
            'editable'=>true,
            'creatable'=>true,
            'show'=>true,
            'thClass'=>'',
            'valueClass'=>'',
            'filter'=>true
        ],
       
    ];


    
    public $deleteRowModal = false;
    public $editRowModal = false;
    public $addRowModal = false;
    
    public $creatableFields = [];
	public $editableFields = [];

    public $selectedIndex;

    public $filter = null;


    public function render()
    {

        $rows = Purchase::orderBy('id', 'desc');

        if($this->filter != null){
            $step = 0;
            foreach($this->fieldsOptions as $key=>$item){
                if($item['filter'] == true){
                    if($step == 0){
                        $rows = $rows->where($item['field'],'like',"%{$this->filter}%");
                        $step++;
                    }else{
                        $rows = $rows->orWhere($item['field'],'like',"%{$this->filter}%");  
                    }              
                }
            }
        }

        $rows = $rows->paginate(10);

        $this->setEditableFields($rows);

        return view('livewire.purchases',[
        	'rows'=>$rows
        ]);
    }


    
    function setEditableFields($rows){

        if(isset($this->selectedIndex)){
           

           foreach($rows as $key=>$row){

               
               if($key == $this->selectedIndex){

                   

                   foreach($row->toArray() as $key_=>$value){
                     $this->editableFields[$key_] = $value;
                   }


               }
           }
       }
          
   }


   public function openAddModal(){
       $this->addRowModal = true;
   }

   public function createCancel(){
       $this->addRowModal = false;
   }

   public function createOk(){
      
       $row = new Purchase;
      
       foreach ($this->creatableFields as $key => $creatableField) {
          $row->{$key} = $creatableField;
       }
    

       $row->save();

       $this->addRowModal = false;
   }

   public function openDeleteModal($index){
       $this->deleteRowModal = true;
       $this->setIndex($index);
   }

   public function setIndex($index){
       $this->selectedIndex = $index;
   }

   public function unsetIndex(){
       $this->selectedIndex = null;
   }


   public function deleteCancel(){
       $this->deleteRowModal = false;
   }

   
   public function deleteOk(Purchase $model){  //Edit this argument, add Model name
       
       $model->delete();

       $this->deleteRowModal = false;
       $this->unsetIndex();
   }



   public function openEditModal($index){

       $this->editRowModal = true;
       $this->editableFields = null;
       $this->setIndex($index);

   }

    public function editCancel(){
       $this->editRowModal = false;
   }

   
   public function editOk(Purchase $model){  //Edit this argument, add Model name
      
       foreach ($this->editableFields as $key => $editableField) {
          $model->{$key} = $editableField;
       }
       
       $model->update();

       $this->editRowModal = false;
   }
   



}


