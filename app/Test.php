<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    // 指定したカラムの物を全て取得
    public function selectAll()
    {
        $query = \DB::table('product')->select('id', 'name', 'price', 'stock')->get();
        return $query;
    }

    // id検索した後に一番最初だけ取得
    public function whereFirst(Request $req)
    {
        $query = \DB::table('product')->where('id', $req->id)->first();
        return $query;
    }

    // 会社テーブルの会社番号と、商品テーブルの会社番号を繋げて全て取得
    public function LeftAll()
    {
        $query = \DB::table('product')->leftjoin('companies', 'comanies.id', '=', 'products.company_id')->get();
        return $query;
    }

    // id検索で出てきたレコードに対してRequestで貰った物を設定して更新している
    public function updateProduct(Request $req)
    {
        \DB::table('product')
            ->where('id', $req->id)
            ->update([
                'id' => $req->id,
                'name' => $req->name,
                'price' => $req->price,
                'stock' => $req->stock,
            ]);
    }

    // Requestで貰った物を設定し、レコードを挿入している
    public function insertProduct(Request $req)
    {
        \DB::table('product')->insert([
            'id' => $req->id,
            'name' => $req->name,
            'price' => $req->price,
            'stock' => $req->stock,
        ]);
    }

    // id検索した物を削除している
    public function whereDelete(Request $req)
    {
        \DB::table('product')->where('id', $req->id)->delete();
    }
}
