<?php

class TransactionModel {

    public function GET_DATA() {
        $get = DB::table('transactions')
                        ->select('id_transaction', 'company_name', 'transaction_name', 'transactions.remarks', 'created_at')
                        ->join('companies', 'companies.id_company', '=', 'transactions.id_company')
                        ->orderBy('companies.id_company', 'desc')
                        ->distinct()->get();
        return $get;
    }

    public function GET_COMPANY_LIST() {
        $lists = DB::table('companies')->orderBy('company_name')->lists('company_name', 'id_company');
        return $lists;
    }

    public function insert() {
        $use_me_for_date = date('Y-m-d H:i:s');
        $array_input = Input::all();
        $array_insert = array(
            'id_company' => $array_input['company_name'],
            'transaction_name' => $array_input['transaction_name'],
            'remarks' => $array_input['remarks'],
            'created_at' => $use_me_for_date
        );
        DB::beginTransaction();
        try {
            if (!empty($array_input['id_transaction'])) {
                DB::table('transactions')->where('id_transaction', $array_input['id_transaction'])->update($array_insert);
            } else {
                DB::table('transactions')->insert($array_insert);
            }
            DB::commit();
        } catch (Exception $ex) {
            print_r($ex->getMessage());
            DB::rollback();
        }
    }

    public function get_using_id($id) {
        $first = DB::table('transactions')->select('id_transaction', 'id_company', 'transaction_name', 'remarks')->where('id_transaction', '=', $id)->first();
        return $first;
    }

    public function delete_id() {
        $id = Input::get('id');
        DB::beginTransaction();
        try {
            DB::table('transactions')->where('id_transaction', $id)->delete();
            DB::commit();
        } catch (Exception $ex) {
            print_r($ex->getMessage());
            DB::rollback();
        }
    }

}
