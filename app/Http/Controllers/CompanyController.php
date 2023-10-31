<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class CompanyController extends Controller
{
    public function index()
    {
        $data = [
            'title' => "Data Perusahaan",
            'content' => "admin/company/index"
        ];

        return view("admin.layouts.wrapper", $data);
    }

    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        $data = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'email' => 'sometimes',
            'phone' => 'required',
            'note' => 'required',
            'tagline' => 'required',
            'logo_url' => 'sometimes|mimes:jpg,png,jpeg,gif|max:1024',
            'icon_url' => 'sometimes|mimes:jpg,png,jpeg,ico|max:1024',
        ]);
        $data['user_id'] = auth()->user()->id;
        $data['email'] =  $data['email'] ? $data['email'] : "";

        if($request->hasFile('logo_url')) {
            if($company->logo_url != null) {
                Storage::delete($company->logo_url);
            }

            $data['logo_url'] = $request->file("logo_url")->store('img');
        } else {
            $data['logo_url'] =  $company->logo_url;
        }

        if($request->hasFile('icon_url')) {
            if($company->icon_url != null) {
                Storage::delete($company->icon_url);
            }

            $data['icon_url'] = $request->file("icon_url")->store('img');
        } else {
            $data['icon_url'] =  $company->icon_url;
        }

        $company->update($data);
        Alert::success('Sukses', 'Data berhasil diupdate.');

        return redirect("/admin/company");
    }

    public function socialMedia()
    {
        $data = [
            'title' => "Data Sosial Media",
            'content' => "admin/company/social-media"
        ];

        return view("admin.layouts.wrapper", $data);
    }

    public function updateSocialMedia(Request $request, $id)
    {
        $company = Company::find($id);
        $data = $request->validate([
            'instagram' => 'nullable',
            'facebook' => 'nullable',
            'youtube' => 'nullable',
            'google_map' => 'nullable',
        ]);
        $data['user_id'] = auth()->user()->id;

        $company->update($data);
        Alert::success('Sukses', 'Data berhasil diupdate.');

        return redirect("/admin/social-media");
    }

    public function banner()
    {
        $data = [
            'title' => "Data banner",
            'content' => "admin/web/banner"
        ];

        return view("admin.layouts.wrapper", $data);
    }

    public function updateBanner(Request $request, $id)
    {
        $company = Company::find($id);
        $data = $request->validate([
            'banner_url' => 'sometimes|mimes:jpg,png,jpeg,gif|max:1024',
        ]);
        $data['user_id'] = auth()->user()->id;

        if($request->hasFile('banner_url')) {
            if($company->banner_url != null) {
                Storage::delete($company->banner_url);
            }

            $data['banner_url'] = $request->file("banner_url")->store('img');
        } else {
            $data['banner_url'] =  $company->banner_url;
        }

        $company->update($data);
        Alert::success('Sukses', 'Data berhasil diupdate.');

        return redirect("/admin/web/banner");
    }
}
