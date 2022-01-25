<?php

namespace App\Exports;

use App\Models\Voucher;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VoucherExport implements FromCollection, WithHeadings
{


    /**
     * @param array $filters
     * @return \Illuminate\Support\Collection
     */

    public function __construct( array $filters){
        $this->filters = $filters;
    }

    public function collection()
    {
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
            ->get();
    }

    public function headings(): array
    {
        return [
            'voucher',
            'CBA',
            'brand',
            'account_name',
            'voucher_status',
            'customer_last_name',
            'confirmation',
            'issue_iata',
            'groos_amount',
        ];
    }
}
