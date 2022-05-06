<?php

namespace App\Http\Livewire;
use App\Models\Invoice;
use Livewire\WithPagination;
use App\Models\Purchase;

use Livewire\Component;

class Invoices extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    public $model = 'Invoice';
    public $pageTitle = 'Invoices';

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
            'field'=>'total',
            'label'=>'Total',
            'locale_label'=>true,
            'editable'=>true,
            'creatable'=>true,
            'show'=>true,
            'thClass'=>'',
            'valueClass'=>'',
            'filter'=>true
        ],

       /* [
            'field'=>'sub_total',
            'label'=>'sub_Total',
            'locale_label'=>true,
            'editable'=>true,
            'creatable'=>true,
            'show'=>true,
            'thClass'=>'',
            'valueClass'=>'',
            'filter'=>true
        ],*/

        [
            'field'=>'total_tax',
            'label'=>'Tax',
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
            'label'=>'user_id',
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
    public $detailsRowModal = false;
    
    public $creatableFields = [];
	public $editableFields = [];

    public $selectedIndex;

    public $filter = null;


    public function render()
    {

        $rows = Invoice::orderBy('id', 'desc');

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

        //dump($rows[0]->purchases()->get());

        $this->setEditableFields($rows);

        return view('livewire.invoices',[
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
      
       $row = new Invoice;
      
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

   
   public function deleteOk(Invoice $model){  //Edit this argument, add Model name
       
       $model->delete();

       $this->deleteRowModal = false;
       $this->unsetIndex();
   }



   public function openEditModal($index){

       $this->editRowModal = true;
       $this->editableFields = null;
       $this->setIndex($index);

   }

   public function openDetailsModal($index){

    $this->detailsRowModal = true;
    $this->setIndex($index);

}

    public function editCancel(){
       $this->editRowModal = false;
   }

   
   public function editOk(Invoice $model){  //Edit this argument, add Model name
      
       foreach ($this->editableFields as $key => $editableField) {
          $model->{$key} = $editableField;
       }
       
       $model->update();

       $this->editRowModal = false;
   }


   
   public function generate_invoices(){
    $purchases = Purchase::where(['invoice_id'=>null])->orderBy('user_id', 'desc')->selectRaw("SUM(total_tax) as total_tax")->selectRaw("SUM(price) as total, user_id")->groupBy('user_id')->get();
     
    
     foreach($purchases as $key=>$purchase){
           $invoice = new Invoice;
           $invoice->user_id = $purchase->user_id;
           $invoice->total = $purchase->total;
           $invoice->total_tax = $purchase->total_tax;
           $invoice->sub_total = 0;
           $invoice->save();
           

           $user_purchases = Purchase::where(['user_id'=>$purchase->user_id,'invoice_id'=>null]);

           $user_purchases->update(['invoice_id'=>$invoice->id]);
           
     }

   }
   



}


