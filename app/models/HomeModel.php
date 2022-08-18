<?php

class HomeModel {

    public function GET_DATA() {
        $get = DB::table('companies')->select('id_company', 'company_name', 'remarks', 'date_established')->orderBy('id_company', 'desc')->distinct()->get();
        return $get;
    }

    public function insert() {
        $array_input = Input::all();
        $array_insert = array(
            'company_name' => $array_input['company_name'],
            'remarks' => $array_input['remarks'],
            'date_established' => $array_input['date_established']
        );
        DB::beginTransaction();
        try {
            if (!empty($array_input['id_company'])) {
                DB::table('companies')->where('id_company', $array_input['id_company'])->update($array_insert);
            } else {
                DB::table('companies')->insert($array_insert);
            }
            DB::commit();
        } catch (Exception $ex) {
            print_r($ex->getMessage());
            DB::rollback();
        }
    }

    public function get_using_id($id) {
        $first = DB::table('companies')->select('id_company', 'company_name', 'remarks', 'date_established')->where('id_company', '=', $id)->first();
        return $first;
    }

    public function delete_id() {
        $id = Input::get('id');
        DB::beginTransaction();
        try {
            DB::table('companies')->where('id_company', $id)->delete();
            DB::commit();
        } catch (Exception $ex) {
            print_r($ex->getMessage());
            DB::rollback();
        }
    }

}
