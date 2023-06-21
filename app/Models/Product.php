<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Intervention\Image\Facades\Image;

use function PHPUnit\Framework\returnSelf;

class Product extends Model
{
    use HasFactory, HasSlug;
    protected $fillable = [
            "title",
            "content",
            "image",
            "category_id",
            "availability",
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    
    public function conditions(){
        return $this->belongsToMany(Condition::class);
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public static function add(array $input){
        $product = new static;
        $product->fill($input);
        $product->content = $input["text"];
        $product->category_id = $input["category"];
        $product->save();

        return $product;
    }

    
    public function getAvailabilityStatus(){
        if ($this -> availability){
            return '<span class="badge text-bg-success">да</span>';
        }
        return '<span class="badge text-bg-danger">нет</span>';
    }

    public function uploadImage($file){
        if ($file == null) return false;
        $originalFileName = 'image_' . $this->id . '.' . $file->extension();
        $middleFileName = 'image_' . $this->id . '_middle.' . $file->extension();
        $smallFileName = 'image_' . $this->id . '_small.' . $file->extension();

    
        $path = 'products/product_' . $this->id . '/';


        if(!File::exists('uploads/' . $path)) {
            File::makeDirectory('uploads/' . $path);
        }


        $compressImageFull = Image::make($file);

        $compressImageFull->save('uploads/' . $path . '/' . $originalFileName, 100);

        $compressImageMiddle = Image::make($file);
        $compressImageMiddle->resize(600, null, function($constraint){
            $constraint->aspectRatio();
        })->save('uploads/' . $path . '/' . $middleFileName, 100);

        $compressImageSmall = Image::make($file);
        $compressImageSmall->resize(300, null, function($constraint){
            $constraint->aspectRatio();
        })->save('uploads/' . $path . '/' . $smallFileName, 100);


        $this->removeImage();
        $file->storeAs($path, $originalFileName,'uploads');
        $this->image = $path . $originalFileName;
        $this-> save();
    }

    public function getImage(){
        $image = $this->image;

        if($image) {
            return asset(('uploads/'. $image));
        }
        return asset("assets/images/no_image.png");
    }

    public function removeImage(){
        if($this->image){
            Storage::disk("uploads")->delete($this->image);
            $this->image = null;
            $this->save();
        }
    }
    public function remove(){
        $this->removeImage();
        $this->delete();
    }
    public function getPrice(){
        return number_format($this->price, 2, ",", " ") . " руб";
    }
}
