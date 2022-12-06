<?php

namespace App\Jobs;

use App\Models\QrCode;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessPodcast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $file;
    /*
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /*
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $path = public_path("upload/images");
        $count = count($this->file);
        for ($i=0; $i<$count; $i++) { 
            $filename = "$path/qr-$i.png";
            QrCode::format("png")->size(90)->generate($this->file[$i], $filename);
            $back = imagecreatefrompng(public_path("images/fon.png"));
            $front = imagecreatefrompng(public_path("images/qr-$i.png"));
            imagealphablending($back, true);
            imagesavealpha($back, true);
            imagecopy($back, $front, 450, 300, 0, 0, 90, 90);
            imagepng($back, "images/natija-$i.png");
        
            $model = new QrCode();
            $model->name = $this->file[$i];
            $model->url = $filename;
            return view("welcome", ["data" => $model]);
            $model->save();
        }
    }
}
