<?php

namespace App\Http\Livewire;

use App\Exports\VoucherExport;
use App\Models\Company;
use App\Models\Voucher;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel;


class ShowVouchers extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';


    protected $queryString =['voucher'=>['except'=>''] ,'account'=>['except'=>''],'dateStart'=>['except'=>''],'dateEnd'=>['except'=>''],'brand'=>['except'=>''],'perPage'=>['except'=>''],'page'=>['except'=>'']];

    public $voucher = '';
    public $account = '';
    public $dateStart = '';
    public $dateEnd = '';
    public $brand = '';

    public $filters = [
        'voucher' => '',
        'account' => '',
        'dateStart' => '',
        'dateEnd' => '',
        'brand' => '',
    ];

    public $perPage = 10;


    public function getVouchers(){
        return Voucher::select('vouchers.id as id','vouchers.number as voucher',
            'vouchers.account as cba', 'companies.name as brand', 'organizations.name as account_name',
            'voucher_status.name as voucher_status','bookings.last_name as customer_last_name',
            'bookings.number as confirmation','vouchers.iata_code as issue_iata', 'vouchers.gross_amount')
            ->join('organizations','vouchers.organization_id','=','organizations.id')
            ->join('companies','vouchers.company_id','=','companies.id')
            ->join('voucher_status','vouchers.voucher_status_id','=','voucher_status.id')
            ->join('payment_files','vouchers.payment_file_id','=','payment_files.id')
            ->join('payment_file_status','payment_files.payment_file_status_id','=','payment_file_status.id')
            ->join('bookings','vouchers.booking_id','=','bookings.id')
            ->join('users','vouchers.user_id','=','users.id')

            ->where('vouchers.number','like',$this->filters['voucher'].'%')
            ->where('organizations.name','like','%'.$this->filters['account'].'%')
            ->where('companies.name','like','%'.$this->filters['brand'].'%')
            ->where(function ($q){
                if($this->filters['dateStart'] != ''){
                    $q->where('vouchers.created_at','>=',$this->filters['dateStart']);
                }
            })
            ->where(function ($q){
                if($this->filters['dateEnd'] != ''){
                    $q->where('vouchers.created_at','<=',$this->filters['dateEnd']);
                }
            })

            ->orderBy('id','desc')
            ->paginate($this->perPage);
    }

    public function getBrands(){
        return Company::all();
    }


    public function clear(){
        $this->resetPage();
        $this->voucher = '';
        $this->account = '';
        $this->dateStart = '';
        $this->dateEnd = '';
        $this->brand = '';
        $this->filters['voucher']='';
        $this->filters['account']='';
        $this->filters['dateStart']='';
        $this->filters['dateEnd']='';
        $this->filters['brand']='';
        $this->filters['perPage']='';
        $this->perPage= 10;
    }

    public function search(){
        $this->resetPage();
        $this->filters['voucher']=$this->voucher;
        $this->filters['account']=$this->account ;
        $this->filters['dateStart']=$this->dateStart ;
        $this->filters['dateEnd']=$this->dateEnd;
        $this->filters['brand']=$this->brand;
        $this->filters['perPage']=$this->perPage;
    }

    public function export(){
        return Excel\Facades\Excel::download(new VoucherExport($this->filters),'vouchers.xlsx');
    }

    public function render()
    {
        $vouchers = $this->getVouchers();
        $this->page = 1;
        $brands = $this->getBrands();
        return view('livewire.show-vouchers',compact('vouchers','brands'));
    }
}
