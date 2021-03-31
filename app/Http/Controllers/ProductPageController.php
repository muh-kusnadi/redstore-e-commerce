<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ImageUploaded;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Image;
use File;
use Carbon\Carbon;

class ProductPageController extends Controller
{
    public $path;
    public $fullPath;
    public $dimensions;

    public function __construct(Product $product, ImageUploaded $imageUploaded)
    {
        $this->product          = $product;
        $this->imageUploaded    = $imageUploaded;

        $this->path             = 'assets/images/gallery';
        $this->fullPath         = storage_path('app/public/'.$this->path);
        $this->dimensions       = ['200x200', '600x600', '1080x1440'];
    }

    public function index()
    {
        $products = $this->product->get();

        return view('pages.front.products', [
            'products' => $products
        ]);
    }

    public function detail($id)
    {
        $product = $this->product->findOrFail($id);

        return view('pages.front.product_details', [
            'product' => $product
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validators = Validator::make($data, [
            'title'             => 'required',
            'description'       => 'required|min:5',
            'price'             => 'required',
            'rating'            => 'required',
            'image.*'           => 'required|image|mimes:jpg,png,jpeg'
        ]);

        if($validators->fails()){
            return response()->json([
                'success'   => false,
                'data'      => [],
                'message'   => $validators->errors()->all()
            ], 400);
        }

        if(count($data['image']) > 4) {
            return response()->json([
                'success'   => false,
                'data'      => [],
                'message'   => 'Uploaded images must not be more than 4'
            ], 400);
        }
        
        $data['slug'] = Str::slug($data['title'], '-');
        $store = $this->product->create($data);

        if($store) {

            //JIKA FOLDERNYA BELUM ADA
            if (!File::isDirectory($this->fullPath)) {
                //MAKA FOLDER TERSEBUT AKAN DIBUAT
                File::makeDirectory($this->fullPath, 0777, true);
            }

            //MENGAMBIL FILE IMAGE DARI FORM
            $files = $request->file('image');

            foreach($files as $file) {
                //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
                $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
                Image::make($file)->save($this->fullPath . '/' . $fileName);

                //LOOPING ARRAY DIMENSI YANG DI-INGINKAN
                //YANG TELAH DIDEFINISIKAN PADA CONSTRUCTOR
                foreach($this->dimensions as $dimension) {
                    //memecah dimension
                    $separateDimension = explode("x", $dimension);

                    //MEMBUAT CANVAS IMAGE SEBESAR DIMENSI YANG ADA DI DALAM ARRAY 
                    $canvas = Image::canvas($separateDimension[0], $separateDimension[1]);

                    //RESIZE IMAGE SESUAI DIMENSI YANG ADA DIDALAM ARRAY 
                    //DENGAN MEMPERTAHANKAN RATIO
                    $resizeImage  = Image::make($file)->resize($separateDimension[0], $separateDimension[1], function($constraint) {
                        $constraint->aspectRatio();
                    });

                    //CEK JIKA FOLDERNYA BELUM ADA
                    if (!File::isDirectory($this->fullPath . '/' . $dimension)) {
                        //MAKA BUAT FOLDER DENGAN NAMA DIMENSI
                        File::makeDirectory($this->fullPath . '/' . $dimension, 0777, true);
                    }

                    //MEMASUKAN IMAGE YANG TELAH DIRESIZE KE DALAM CANVAS
                    $canvas->insert($resizeImage, 'center');
                    //SIMPAN IMAGE KE DALAM MASING-MASING FOLDER (DIMENSI)
                    $canvas->save($this->fullPath . '/' . $dimension . '/' . $fileName);
                }

                //SIMPAN DATA IMAGE YANG TELAH DI-UPLOAD
                $this->imageUploaded->create([
                    'product_id'    => $store->id,
                    'name'          => $fileName,
                    'dimensions'    => implode('|', $this->dimensions),
                    'path'          => 'storage/'.$this->path,
                    'extension'     => $file->getClientOriginalExtension()
                ]);
            }

            return response()->json([
                'success'   => true,
                'data'      => $store->with('imageUploaded')->orderBy('id', 'DESC')->first(),
                'message'   => 'Data product successfully stored'
            ], 200);
        }

        return response()->json([
            'success'   => false,
            'data'      => [],
            'message'   => 'Something went wrong'
        ], 400);
    }
}
