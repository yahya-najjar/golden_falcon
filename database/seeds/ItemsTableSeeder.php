<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $about = new \App\Models\Item();
        $about->translateOrNew('ar')->title = 'About Our Shop';
        $about->translateOrNew('ar')->content = "<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur doloremque exercitationem impedit modi
            pariatur provident qui quos. A beatae distinctio dolor error explicabo, harum incidunt laudantium optio repellat
            tempora tempore.
        </div>
        <div>Consectetur consequuntur magnam voluptatum. Aliquam cumque dolore eaque ipsum optio quaerat reiciendis
            reprehenderit sint tempora velit! A inventore laboriosam laudantium necessitatibus quas rerum sit soluta vel.
            Aliquid debitis hic voluptates.
        </div>";
        $about->image = 'about_us.jpg';
        $about->type = 4;
        $about->save();
    }
}
