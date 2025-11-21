<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Empty the table first
        Item::truncate();

        $item1 = new Item();
        $item1->name = "Flash Drive";
        $item1->description = "A standard USB portable storage device.";
        $item1->type = "Electronics/Storage";
        $item1->save();

        $item2 = new Item();
        $item2->name = "Textbook";
        $item2->description = "A general academic textbook.";
        $item2->type = "Book/Textbook";
        $item2->save();

        $item3 = new Item();
        $item3->name = "Calculator";
        $item3->description = "A scientific or graphing calculator.";
        $item3->type = "Electronics/Tool";
        $item3->save();

        $item4 = new Item();
        $item4->name = "Planner";
        $item4->description = "A book used for scheduling.";
        $item4->type = "Document/Stationery";
        $item4->save();

        $item5 = new Item();
        $item5->name = "Laptop Charger";
        $item5->description = "A power adapter for a portable computer.";
        $item5->type = "Electronics/Accessory";
        $item5->save();

        $item6 = new Item();
        $item6->name = "Water Bottle";
        $item6->description = "A large reusable drinking container.";
        $item6->type = "Container/Beverage";
        $item6->save();

        $item7 = new Item();
        $item7->name = "Course Syllabus";
        $item7->description = "A printed document detailing class requirements.";
        $item7->type = "Document/Paperwork";
        $item7->save();

        $item8 = new Item();
        $item8->name = "Single Earbud";
        $item8->description = "One piece of a wireless headphone set.";
        $item8->type = "Electronics/Audio";
        $item8->save();

        $item9 = new Item();
        $item9->name = "Lanyard and Key";
        $item9->description = "A fabric strap with an attached key.";
        $item9->type = "Personal ID/Key";
        $item9->save();

        $item10 = new Item();
        $item10->name = "Library Card";
        $item10->description = "A plastic card for borrowing items.";
        $item10->type = "Personal ID/Card";
        $item10->save();

        // ---------------------------------------------
        // 🏃 Apparel & Accessories
        // ---------------------------------------------

        $item11 = new Item();
        $item11->name = "Hoodie";
        $item11->description = "A long-sleeved hooded sweatshirt.";
        $item11->type = "Clothing/Apparel";
        $item11->save();

        $item12 = new Item();
        $item12->name = "Single Glove";
        $item12->description = "One piece of hand covering apparel.";
        $item12->type = "Clothing/Apparel";
        $item12->save();

        $item13 = new Item();
        $item13->name = "Locker Key";
        $item13->description = "A key for a storage locker.";
        $item13->type = "Key";
        $item13->save();

        $item14 = new Item();
        $item14->name = "Wireless Headphones";
        $item14->description = "An over-the-ear or in-ear wireless audio device.";
        $item14->type = "Electronics/Audio";
        $item14->save();

        $item15 = new Item();
        $item15->name = "Beanie Hat";
        $item15->description = "A simple knit cap.";
        $item15->type = "Clothing/Apparel";
        $item15->save();

        $item16 = new Item();
        $item16->name = "Reading Glasses";
        $item16->description = "Eyewear used for vision correction.";
        $item16->type = "Personal Accessory";
        $item16->save();

        $item17 = new Item();
        $item17->name = "House Key";
        $item17->description = "A common key for residential access.";
        $item17->type = "Key";
        $item17->save();

        $item18 = new Item();
        $item18->name = "Umbrella";
        $item18->description = "A device for protection from rain.";
        $item18->type = "Personal Accessory";
        $item18->save();

        $item19 = new Item();
        $item19->name = "Backpack Rain Cover";
        $item19->description = "A protective shield for a backpack.";
        $item19->type = "Accessory";
        $item19->save();

        $item20 = new Item();
        $item20->name = "Wristwatch";
        $item20->description = "A device worn on the wrist to tell time.";
        $item20->type = "Personal Accessory";
        $item20->save();

        // ---------------------------------------------
        // 💳 Personal & Financial Items
        // ---------------------------------------------

        $item21 = new Item();
        $item21->name = "Debit Card";
        $item21->description = "A standard bank card used for purchases.";
        $item21->type = "Personal ID/Card";
        $item21->save();

        $item22 = new Item();
        $item22->name = "Coin Pouch";
        $item22->description = "A small bag for carrying change.";
        $item22->type = "Container/Financial";
        $item22->save();

        $item23 = new Item();
        $item23->name = "Wallet";
        $item23->description = "A container for identification and cash.";
        $item23->type = "Container/Financial";
        $item23->save();

        $item24 = new Item();
        $item24->name = "Driver's License";
        $item24->description = "Official government identification.";
        $item24->type = "Personal ID/Card";
        $item24->save();

        $item25 = new Item();
        $item25->name = "Transit Pass";
        $item25->description = "A card used for public transportation.";
        $item25->type = "Personal ID/Card";
        $item25->save();

        $item26 = new Item();
        $item26->name = "Earbud Charging Case";
        $item26->description = "A plastic case for recharging wireless earbuds.";
        $item26->type = "Electronics/Accessory";
        $item26->save();

        $item27 = new Item();
        $item27->name = "Hand Sanitizer";
        $item27->description = "A small bottle of cleaning gel.";
        $item27->type = "Personal Accessory";
        $item27->save();

        $item28 = new Item();
        $item28->name = "Prescription Bottle";
        $item28->description = "A container for dispensed medication.";
        $item28->type = "Medical/Personal";
        $item28->save();

        $item29 = new Item();
        $item29->name = "Car Key Fob";
        $item29->description = "An electronic device for locking a car.";
        $item29->type = "Key/Electronics";
        $item29->save();

        $item30 = new Item();
        $item30->name = "Single Earring";
        $item30->description = "One piece of small jewelry.";
        $item30->type = "Jewelry";
        $item30->save();

        // ---------------------------------------------
        // 🖼️ Unique & Miscellaneous Items
        // ---------------------------------------------

        $item31 = new Item();
        $item31->name = "Sketchbook";
        $item31->description = "A notebook containing drawings.";
        $item31->type = "Document/Art";
        $item31->save();

        $item32 = new Item();
        $item32->name = "Lab Goggles";
        $item32->description = "Protective eyewear for experiments.";
        $item32->type = "Tool/Safety Gear";
        $item32->save();

        $item33 = new Item();
        $item33->name = "Guitar Picks";
        $item33->description = "A small container of plectrums.";
        $item33->type = "Musical Accessory";
        $item33->save();

        $item34 = new Item();
        $item34->name = "Roll of Film";
        $item34->description = "Unused photographic film.";
        $item34->type = "Media/Photography";
        $item34->save();

        $item35 = new Item();
        $item35->name = "Dictionary";
        $item35->description = "A reference book for language translation.";
        $item35->type = "Book/Reference";
        $item35->save();

        $item36 = new Item();
        $item36->name = "Fountain Pen";
        $item36->description = "A fine writing instrument.";
        $item36->type = "Stationery/Tool";
        $item36->save();

        $item37 = new Item();
        $item37->name = "Coffee Mug";
        $item37->description = "A ceramic cup for hot beverages.";
        $item37->type = "Container/Beverage";
        $item37->save();

        $item38 = new Item();
        $item38->name = "Passport";
        $item38->description = "A national travel document.";
        $item38->type = "Personal ID/Document";
        $item38->save();

        $item39 = new Item();
        $item39->name = "Portable Speaker";
        $item39->description = "A small wireless audio output device.";
        $item39->type = "Electronics/Audio";
        $item39->save();

        $item40 = new Item();
        $item40->name = "Tennis Ball";
        $item40->description = "A sports ball.";
        $item40->type = "Toy/Sporting Good";
        $item40->save();

        // ---------------------------------------------
        // 📇 Documents & Accessories
        // ---------------------------------------------

        $item41 = new Item();
        $item41->name = "Set of Resumes";
        $item41->description = "Multiple copies of a job application document.";
        $item41->type = "Document/Paperwork";
        $item41->save();

        $item42 = new Item();
        $item42->name = "Business Cards";
        $item42->description = "A stack of professional contact cards.";
        $item42->type = "Document/Paperwork";
        $item42->save();

        $item43 = new Item();
        $item43->name = "Sticky Notes";
        $item43->description = "A pad of small adhesive papers.";
        $item43->type = "Document/Stationery";
        $item43->save();

        $item44 = new Item();
        $item44->name = "Hard Drive";
        $item44->description = "An external computer data storage device.";
        $item44->type = "Electronics/Storage";
        $item44->save();

        $item45 = new Item();
        $item45->name = "Stapler";
        $item45->description = "A desk tool used for binding papers.";
        $item45->type = "Tool/Stationery";
        $item45->save();

        $item46 = new Item();
        $item46->name = "Pencil Pouch";
        $item46->description = "A bag containing writing or drawing tools.";
        $item46->type = "Container/Stationery";
        $item46->save();

        $item47 = new Item();
        $item47->name = "Gift Card";
        $item47->description = "A prepaid store value card.";
        $item47->type = "Personal ID/Card";
        $item47->save();

        $item48 = new Item();
        $item48->name = "Sign-up Sheet";
        $item48->description = "A list containing student names and details.";
        $item48->type = "Document/Paperwork";
        $item48->save();

        $item49 = new Item();
        $item49->name = "Dry-Erase Marker";
        $item49->description = "A tool for writing on whiteboards.";
        $item49->type = "Stationery/Tool";
        $item49->save();

        $item50 = new Item();
        $item50->name = "Power Bank";
        $item50->description = "A portable device for charging electronics.";
        $item50->type = "Electronics/Accessory";
        $item50->save();
    }
}
