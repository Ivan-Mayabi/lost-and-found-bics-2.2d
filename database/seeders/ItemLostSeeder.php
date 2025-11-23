<?php

namespace Database\Seeders;

use App\Models\ItemLost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemLostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Empty the table first
        ItemLost::truncate();

        // All code beyond this point generated from AI.

        // --- HELPER FUNCTIONS ---
        // These helpers use Carbon internally for date math but return a string, 
        // as requested.
        $imgBase = 'https://via.placeholder.com/640x480.png/009933?text=';
        
        $shiftDate = function ($dateString, $months) {
            return \Carbon\Carbon::parse($dateString)->addMonths($months)->toDateTimeString();
        };

        $getTakenDate = function ($lostDate) {
            // Generates a random date between 1 and 3 days AFTER the lost date
            return \Carbon\Carbon::parse($lostDate)->addDays(rand(1, 3))->toDateTimeString();
        };

        $getUser = function () {
            // Returns a random user ID between 1 and 50
            return rand(1, 50);
        };
        // --- END HELPERS ---

        // =============================================
        // ITEMS 1-60: NOT TAKEN (60% - taken = 0)
        // 'taken', 'date_taken', and 'user_taken_id' fields are omitted.
        // =============================================

        // --- ITEMS 1-30 (Original Dates, taken = 0) ---

        $item_lost1 = new ItemLost();
        $item_lost1->item_id = 1; 
        $item_lost1->description = "A small 32GB USB flash drive, silver with a black cap.";
        $item_lost1->date_lost = '2025-11-21 14:30:00';
        $item_lost1->place_lost = 'Near the entrance of Lecture Hall A';
        $item_lost1->image_url = $imgBase . 'USB+Flash+Drive';
        $item_lost1->save();

        $item_lost2 = new ItemLost();
        $item_lost2->item_id = 2; 
        $item_lost2->description = "A Chemistry 101 textbook, slightly worn cover, dog-eared pages.";
        $item_lost2->date_lost = '2025-02-25 09:15:00';
        $item_lost2->place_lost = 'Rowe Coves Dormitory Lounge';
        $item_lost2->image_url = $imgBase . 'Chemistry+Textbook';
        $item_lost2->save();

        $item_lost3 = new ItemLost();
        $item_lost3->item_id = 3; 
        $item_lost3->description = "A black Texas Instruments graphing calculator (TI-84 Plus).";
        $item_lost3->date_lost = '2024-05-24 11:45:00';
        $item_lost3->place_lost = 'Hagenes Plaza Food Court';
        $item_lost3->image_url = $imgBase . 'TI-84+Calculator';
        $item_lost3->save();

        $item_lost4 = new ItemLost();
        $item_lost4->item_id = 4; 
        $item_lost4->description = "A blue leather-bound weekly planner, current year, with names written inside.";
        $item_lost4->date_lost = '2023-10-16 16:00:00';
        $item_lost4->place_lost = 'Molly Flats Library, Study Zone 3';
        $item_lost4->image_url = $imgBase . 'Blue+Planner';
        $item_lost4->save();

        $item_lost5 = new ItemLost();
        $item_lost5->item_id = 5; 
        $item_lost5->description = "A white MacBook Pro USB-C power adapter.";
        $item_lost5->date_lost = '2025-08-01 10:20:00';
        $item_lost5->place_lost = 'Second floor of the Student Union Building';
        $item_lost5->image_url = $imgBase . 'MacBook+Charger';
        $item_lost5->save();

        $item_lost6 = new ItemLost();
        $item_lost6->item_id = 6; 
        $item_lost6->description = "A large stainless steel water bottle, dark blue, with a sticker from the gym.";
        $item_lost6->date_lost = '2025-09-12 15:55:00';
        $item_lost6->place_lost = 'Gymnasium changing rooms';
        $item_lost6->image_url = $imgBase . 'Blue+Water+Bottle';
        $item_lost6->save();

        $item_lost7 = new ItemLost();
        $item_lost7->item_id = 7; 
        $item_lost7->description = "A stapled packet for the 'Introduction to Philosophy' course.";
        $item_lost7->date_lost = '2024-11-05 08:35:00';
        $item_lost7->place_lost = 'Professor Smith\'s office hours waiting area (Room 101)';
        $item_lost7->image_url = $imgBase . 'Philosophy+Syllabus';
        $item_lost7->save();

        $item_lost8 = new ItemLost();
        $item_lost8->item_id = 8; 
        $item_lost8->description = "A single white Apple AirPod (left side).";
        $item_lost8->date_lost = '2025-04-18 19:40:00';
        $item_lost8->place_lost = 'Bus stop near the main campus gate';
        $item_lost8->image_url = $imgBase . 'Single+AirPod';
        $item_lost8->save();

        $item_lost9 = new ItemLost();
        $item_lost9->item_id = 9; 
        $item_lost9->description = "A red fabric lanyard with a single silver key attached.";
        $item_lost9->date_lost = '2025-07-03 12:00:00';
        $item_lost9->place_lost = 'Bookstore checkout counter';
        $item_lost9->image_url = $imgBase . 'Red+Lanyard+Key';
        $item_lost9->save();

        $item_lost10 = new ItemLost();
        $item_lost10->item_id = 10; 
        $item_lost10->description = "A standard campus library card with a student photo.";
        $item_lost10->date_lost = '2025-01-20 13:10:00';
        $item_lost10->place_lost = 'The main lobby of the Sciences Building';
        $item_lost10->image_url = $imgBase . 'Library+Card';
        $item_lost10->save();

        $item_lost11 = new ItemLost();
        $item_lost11->item_id = 11; 
        $item_lost11->description = "A grey zippered hoodie, size large, with the university logo on the chest.";
        $item_lost11->date_lost = '2025-03-05 17:50:00';
        $item_lost11->place_lost = 'The benches outside the dining hall';
        $item_lost11->image_url = $imgBase . 'Grey+University+Hoodie';
        $item_lost11->save();

        $item_lost12 = new ItemLost();
        $item_lost12->item_id = 12; 
        $item_lost12->description = "A black knitted winter glove, right hand only.";
        $item_lost12->date_lost = '2025-01-08 07:40:00';
        $item_lost12->place_lost = 'Patterson Hall 4th floor stairwell';
        $item_lost12->image_url = $imgBase . 'Black+Knit+Glove';
        $item_lost12->save();

        $item_lost13 = new ItemLost();
        $item_lost13->item_id = 13; 
        $item_lost13->description = "A small brass key stamped with the number '42B'.";
        $item_lost13->date_lost = '2024-12-19 14:00:00';
        $item_lost13->place_lost = 'Basement lockers near the swimming pool';
        $item_lost13->image_url = $imgBase . 'Locker+Key+42B';
        $item_lost13->save();

        $item_lost14 = new ItemLost();
        $item_lost14->item_id = 14; 
        $item_lost14->description = "Black Sony over-the-ear noise-cancelling headphones in a soft case.";
        $item_lost14->date_lost = '2025-06-28 20:15:00';
        $item_lost14->place_lost = 'The quiet study area in the law school building';
        $item_lost14->image_url = $imgBase . 'Sony+Headphones';
        $item_lost14->save();

        $item_lost15 = new ItemLost();
        $item_lost15->item_id = 15; 
        $item_lost15->description = "A thick wool beanie, maroon color.";
        $item_lost15->date_lost = '2025-02-14 10:50:00';
        $item_lost15->place_lost = 'Outside the main lecture theatre (Room 200)';
        $item_lost15->image_url = $imgBase . 'Maroon+Beanie+Hat';
        $item_lost15->save();
        
        $item_lost16 = new ItemLost();
        $item_lost16->item_id = 16; 
        $item_lost16->description = "Thin silver-rimmed reading glasses, prescription -1.5.";
        $item_lost16->date_lost = '2025-09-01 16:25:00';
        $item_lost16->place_lost = 'In a textbook in the Art History room';
        $item_lost16->image_url = $imgBase . 'Silver+Reading+Glasses';
        $item_lost16->save();

        $item_lost17 = new ItemLost();
        $item_lost17->item_id = 17; 
        $item_lost17->description = "Two simple house keys on a small ring with a blue plastic tag.";
        $item_lost17->date_lost = '2024-10-09 11:00:00';
        $item_lost17->place_lost = 'Main parking lot, near row K';
        $item_lost17->image_url = $imgBase . 'House+Keys+Blue+Tag';
        $item_lost17->save();

        $item_lost18 = new ItemLost();
        $item_lost18->item_id = 18; 
        $item_lost18->description = "A black, collapsible umbrella with a wooden handle.";
        $item_lost18->date_lost = '2025-04-29 13:40:00';
        $item_lost18->place_lost = 'The umbrella stand outside the faculty center';
        $item_lost18->image_url = $imgBase . 'Black+Umbrella';
        $item_lost18->save();

        $item_lost19 = new ItemLost();
        $item_lost19->item_id = 19; 
        $item_lost19->description = "A bright yellow, waterproof cover for a medium-sized backpack.";
        $item_lost19->date_lost = '2024-09-15 15:10:00';
        $item_lost19->place_lost = 'On the steps leading to the Engineering building';
        $item_lost19->image_url = $imgBase . 'Yellow+Rain+Cover';
        $item_lost19->save();

        $item_lost20 = new ItemLost();
        $item_lost20->item_id = 20; 
        $item_lost20->description = "A simple digital wristwatch with a faded black rubber strap.";
        $item_lost20->date_lost = '2025-03-22 09:05:00';
        $item_lost20->place_lost = 'Lost near the water fountain on the quad';
        $item_lost20->image_url = $imgBase . 'Black+Digital+Watch';
        $item_lost20->save();

        $item_lost21 = new ItemLost();
        $item_lost21->item_id = 21; 
        $item_lost21->description = "A Visa debit card from 'City Bank', name clearly visible.";
        $item_lost21->date_lost = '2025-05-17 14:00:00';
        $item_lost21->place_lost = 'Dropped near the ATM outside the Student Center';
        $item_lost21->image_url = $imgBase . 'Visa+Debit+Card';
        $item_lost21->save();

        $item_lost22 = new ItemLost();
        $item_lost22->item_id = 22; 
        $item_lost22->description = "A small, worn, zippered coin pouch made of blue canvas.";
        $item_lost22->date_lost = '2025-01-30 18:20:00';
        $item_lost22->place_lost = 'Table 5 in the campus coffee shop';
        $item_lost22->image_url = $imgBase . 'Blue+Coin+Pouch';
        $item_lost22->save();

        $item_lost23 = new ItemLost();
        $item_lost23->item_id = 23; 
        $item_lost23->description = "A brown leather bi-fold wallet containing student ID and cash.";
        $item_lost23->date_lost = '2024-11-28 11:30:00';
        $item_lost23->place_lost = 'Left on the radiator in the History lecture hall';
        $item_lost23->image_url = $imgBase . 'Brown+Leather+Wallet';
        $item_lost23->save();

        $item_lost24 = new ItemLost();
        $item_lost24->item_id = 24; 
        $item_lost24->description = "A standard state driver's license (no wallet attached).";
        $item_lost24->date_lost = '2025-02-09 13:50:00';
        $item_lost24->place_lost = 'On the ground near the bicycle racks';
        $item_lost24->image_url = $imgBase . 'Drivers+License';
        $item_lost24->save();

        $item_lost25 = new ItemLost();
        $item_lost25->item_id = 25; 
        $item_lost25->description = "A weekly public bus pass for the current month.";
        $item_lost25->date_lost = '2025-07-19 09:30:00';
        $item_lost25->place_lost = 'Outside the main library entrance';
        $item_lost25->image_url = $imgBase . 'Weekly+Transit+Pass';
        $item_lost25->save();

        $item_lost26 = new ItemLost();
        $item_lost26->item_id = 26; 
        $item_lost26->description = "A black plastic charging case for wireless earbuds (empty).";
        $item_lost26->date_lost = '2025-08-08 17:00:00';
        $item_lost26->place_lost = 'Under a chair in the Computer Lab, Room 305';
        $item_lost26->image_url = $imgBase . 'Black+Earbud+Case';
        $item_lost26->save();

        $item_lost27 = new ItemLost();
        $item_lost27->item_id = 27; 
        $item_lost27->description = "A small bottle of cherry-scented hand sanitizer with a pink clip.";
        $item_lost27->date_lost = '2024-12-01 12:45:00';
        $item_lost27->place_lost = 'Left on the window sill in the gymnasium hallway';
        $item_lost27->image_url = $imgBase . 'Cherry+Sanitizer';
        $item_lost27->save();

        $item_lost28 = new ItemLost();
        $item_lost28->item_id = 28; 
        $item_lost28->description = "An empty orange prescription bottle labeled for a specific name.";
        $item_lost28->date_lost = '2025-04-04 15:30:00';
        $item_lost28->place_lost = 'Near the recycling bins in the common area';
        $item_lost28->image_url = $imgBase . 'Orange+Pill+Bottle';
        $item_lost28->save();

        $item_lost29 = new ItemLost();
        $item_lost29->item_id = 29; 
        $item_lost29->description = "A black electronic car key fob for a Honda.";
        $item_lost29->date_lost = '2025-06-11 10:10:00';
        $item_lost29->place_lost = 'In the elevator of the administration building';
        $item_lost29->image_url = $imgBase . 'Honda+Car+Fob';
        $item_lost29->save();

        $item_lost30 = new ItemLost();
        $item_lost30->item_id = 30; 
        $item_lost30->description = "One piece of small jewelry.";
        $item_lost30->date_lost = '2024-08-20 19:30:00';
        $item_lost30->place_lost = 'Found on the carpet near the theater stage';
        $item_lost30->image_url = $imgBase . 'Silver+Blue+Earring';
        $item_lost30->save();

        // --- ITEMS 31-60 (Shifted Dates, taken = 0) ---

        $item_lost31 = new ItemLost();
        $item_lost31->item_id = 31; 
        $item_lost31->description = "A large A4 wire-bound sketchbook with graphite pencil drawings inside.";
        $item_lost31->date_lost = $shiftDate('2025-03-28 14:15:00', 6);
        $item_lost31->place_lost = 'Left on an easel in the Art Studio';
        $item_lost31->image_url = $imgBase . 'A4+Sketchbook';
        $item_lost31->save();

        $item_lost32 = new ItemLost();
        $item_lost32->item_id = 32; 
        $item_lost32->description = "Clear protective lab goggles with an adjustable elastic strap.";
        $item_lost32->date_lost = $shiftDate('2024-10-25 08:50:00', 6);
        $item_lost32->place_lost = 'On the counter of Chemistry Lab 403';
        $item_lost32->image_url = $imgBase . 'Lab+Goggles';
        $item_lost32->save();

        $item_lost33 = new ItemLost();
        $item_lost33->item_id = 33; 
        $item_lost33->description = "A clear plastic container holding about 10 assorted guitar picks.";
        $item_lost33->date_lost = $shiftDate('2025-07-22 17:35:00', 6);
        $item_lost33->place_lost = 'In the Music Practice Room 7';
        $item_lost33->image_url = $imgBase . 'Guitar+Picks';
        $item_lost33->save();

        $item_lost34 = new ItemLost();
        $item_lost34->item_id = 34; 
        $item_lost34->description = "An unexposed roll of Kodak 35mm photographic film.";
        $item_lost34->date_lost = $shiftDate('2025-01-13 10:00:00', 6);
        $item_lost34->place_lost = 'Left on a table in the Photography Darkroom';
        $item_lost34->image_url = $imgBase . 'Roll+of+35mm+Film';
        $item_lost34->save();

        $item_lost35 = new ItemLost();
        $item_lost35->item_id = 35; 
        $item_lost35->description = "A large Spanish-English dictionary, well-used with a broken spine.";
        $item_lost35->date_lost = $shiftDate('2024-09-02 14:00:00', 6);
        $item_lost35->place_lost = 'The Language Learning Center, near computer station 4';
        $item_lost35->image_url = $imgBase . 'Spanish+Dictionary';
        $item_lost35->save();

        $item_lost36 = new ItemLost();
        $item_lost36->item_id = 36; 
        $item_lost36->description = "A dark green fountain pen with a gold nib, engraved initials 'A.R.'";
        $item_lost36->date_lost = $shiftDate('2025-05-09 13:05:00', 6);
        $item_lost36->place_lost = 'Found on the podium in the main auditorium';
        $item_lost36->image_url = $imgBase . 'Green+Fountain+Pen';
        $item_lost36->save();

        $item_lost37 = new ItemLost();
        $item_lost37->item_id = 37; 
        $item_lost37->description = "A large white ceramic coffee mug with a picture of a cat on it.";
        $item_lost37->date_lost = $shiftDate('2025-08-15 09:40:00', 6);
        $item_lost37->place_lost = 'Next to the campus coffee machine';
        $item_lost37->image_url = $imgBase . 'Cat+Coffee+Mug';
        $item_lost37->save();

        $item_lost38 = new ItemLost();
        $item_lost38->item_id = 38; 
        $item_lost38->description = "A United States passport, found open on the floor.";
        $item_lost38->date_lost = $shiftDate('2024-11-19 16:30:00', 6);
        $item_lost38->place_lost = 'The International Student Services office';
        $item_lost38->image_url = $imgBase . 'Passport+Document';
        $item_lost38->save();

        $item_lost39 = new ItemLost();
        $item_lost39->item_id = 39; 
        $item_lost39->description = "A small, black, cylindrical JBL portable Bluetooth speaker.";
        $item_lost39->date_lost = $shiftDate('2025-02-01 21:00:00', 6);
        $item_lost39->place_lost = 'Left on the floor in the campus gym weight room';
        $item_lost39->image_url = $imgBase . 'JBL+Bluetooth+Speaker';
        $item_lost39->save();

        $item_lost40 = new ItemLost();
        $item_lost40->item_id = 40; 
        $item_lost40->description = "A single, slightly scuffed yellow tennis ball.";
        $item_lost40->date_lost = $shiftDate('2025-06-03 14:00:00', 6);
        $item_lost40->place_lost = 'Found in the grassy area near the athletic fields';
        $item_lost40->image_url = $imgBase . 'Yellow+Tennis+Ball';
        $item_lost40->save();

        $item_lost41 = new ItemLost();
        $item_lost41->item_id = 41; 
        $item_lost41->description = "A stack of five printed resumes for a Finance major.";
        $item_lost41->date_lost = $shiftDate('2025-03-12 11:30:00', 6);
        $item_lost41->place_lost = 'Career Fair table 12';
        $item_lost41->image_url = $imgBase . 'Stack+of+Resumes';
        $item_lost41->save();

        $item_lost42 = new ItemLost();
        $item_lost42->item_id = 42; 
        $item_lost42->description = "A small, white box containing business cards from a local tech company.";
        $item_lost42->date_lost = $shiftDate('2025-04-20 15:00:00', 6);
        $item_lost42->place_lost = 'The lounge area of the Business School building';
        $item_lost42->image_url = $imgBase . 'Business+Cards';
        $item_lost42->save();

        $item_lost43 = new ItemLost();
        $item_lost43->item_id = 43; 
        $item_lost43->description = "A full pad of yellow square sticky notes.";
        $item_lost43->date_lost = $shiftDate('2025-01-01 09:00:00', 6);
        $item_lost43->place_lost = 'Left on a whiteboard in a study room';
        $item_lost43->image_url = $imgBase . 'Yellow+Sticky+Notes';
        $item_lost43->save();

        $item_lost44 = new ItemLost();
        $item_lost44->item_id = 44; 
        $item_lost44->description = "A black, external 1TB portable hard drive with a USB cable.";
        $item_lost44->date_lost = $shiftDate('2024-12-10 16:45:00', 6);
        $item_lost44->place_lost = 'Found on a desk in the Computer Science department';
        $item_lost44->image_url = $imgBase . 'External+Hard+Drive';
        $item_lost44->save();

        $item_lost45 = new ItemLost();
        $item_lost45->item_id = 45; 
        $item_lost45->description = "A small, red, plastic desk stapler.";
        $item_lost45->date_lost = $shiftDate('2025-05-29 11:50:00', 6);
        $item_lost45->place_lost = 'The copy machine area in the administrative offices';
        $item_lost45->image_url = $imgBase . 'Red+Office+Stapler';
        $item_lost45->save();

        $item_lost46 = new ItemLost();
        $item_lost46->item_id = 46; 
        $item_lost46->description = "A clear plastic pencil pouch containing two pens and a ruler.";
        $item_lost46->date_lost = $shiftDate('2024-10-05 13:00:00', 6);
        $item_lost46->place_lost = 'Found under a seat in Auditorium B';
        $item_lost46->image_url = $imgBase . 'Clear+Pencil+Pouch';
        $item_lost46->save();

        $item_lost47 = new ItemLost();
        $item_lost47->item_id = 47; 
        $item_lost47->description = "A $25 gift card for the campus coffee shop.";
        $item_lost47->date_lost = $shiftDate('2025-02-20 12:00:00', 6);
        $item_lost47->place_lost = 'Near the cash register at the coffee shop';
        $item_lost47->image_url = $imgBase . 'Coffee+Shop+Gift+Card';
        $item_lost47->save();

        $item_lost48 = new ItemLost();
        $item_lost48->item_id = 48; 
        $item_lost48->description = "A paper list titled 'Volunteers for Spring Festival' with 15 names.";
        $item_lost48->date_lost = $shiftDate('2025-07-07 10:30:00', 6);
        $item_lost48->place_lost = 'Taped to a bulletin board outside the Student Activities Center';
        $item_lost48->image_url = $imgBase . 'Volunteer+Sign-up+Sheet';
        $item_lost48->save();

        $item_lost49 = new ItemLost();
        $item_lost49->item_id = 49; 
        $item_lost49->description = "A single black dry-erase marker (thick tip).";
        $item_lost49->date_lost = $shiftDate('2025-03-01 15:40:00', 6);
        $item_lost49->place_lost = 'On the ledge of the whiteboard in Seminar Room 7';
        $item_lost49->image_url = $imgBase . 'Black+Dry+Erase+Marker';
        $item_lost49->save();

        $item_lost50 = new ItemLost();
        $item_lost50->item_id = 50; 
        $item_lost50->description = "A silver 10,000mAh portable battery charger.";
        $item_lost50->date_lost = $shiftDate('2024-09-25 18:00:00', 6);
        $item_lost50->place_lost = 'Left charging on an outlet in the public lounge';
        $item_lost50->image_url = $imgBase . 'Silver+Power+Bank';
        $item_lost50->save();
        
        $item_lost51 = new ItemLost();
        $item_lost51->item_id = 1; // Repeat of Item ID 1
        $item_lost51->description = "A small 32GB USB flash drive, silver with a black cap (newly lost).";
        $item_lost51->date_lost = $shiftDate('2025-11-21 14:30:00', 6);
        $item_lost51->place_lost = 'Near the entrance of Lecture Hall B';
        $item_lost51->image_url = $imgBase . 'USB+Flash+Drive+B';
        $item_lost51->save();

        $item_lost52 = new ItemLost();
        $item_lost52->item_id = 2; // Repeat of Item ID 2
        $item_lost52->description = "A Biology 101 textbook, brand new, blue cover.";
        $item_lost52->date_lost = $shiftDate('2025-02-25 09:15:00', 6);
        $item_lost52->place_lost = 'Faculty Dining Area';
        $item_lost52->image_url = $imgBase . 'Biology+Textbook';
        $item_lost52->save();

        $item_lost53 = new ItemLost();
        $item_lost53->item_id = 3; // Repeat of Item ID 3
        $item_lost53->description = "A white Casio scientific calculator.";
        $item_lost53->date_lost = $shiftDate('2024-05-24 11:45:00', 6);
        $item_lost53->place_lost = 'Room 405 Math Building';
        $item_lost53->image_url = $imgBase . 'White+Calculator';
        $item_lost53->save();

        $item_lost54 = new ItemLost();
        $item_lost54->item_id = 4; // Repeat of Item ID 4
        $item_lost54->description = "A black, leather-bound journal with a lock.";
        $item_lost54->date_lost = $shiftDate('2023-10-16 16:00:00', 6);
        $item_lost54->place_lost = 'Library Cafe Seating';
        $item_lost54->image_url = $imgBase . 'Black+Journal';
        $item_lost54->save();

        $item_lost55 = new ItemLost();
        $item_lost55->item_id = 5; // Repeat of Item ID 5
        $item_lost55->description = "A black Dell laptop charger.";
        $item_lost55->date_lost = $shiftDate('2025-08-01 10:20:00', 6);
        $item_lost55->place_lost = 'Outlet near the front desk of the Library';
        $item_lost55->image_url = $imgBase . 'Dell+Charger';
        $item_lost55->save();

        $item_lost56 = new ItemLost();
        $item_lost56->item_id = 6; // Repeat of Item ID 6
        $item_lost56->description = "A pink plastic water bottle with a motivational quote.";
        $item_lost56->date_lost = $shiftDate('2025-09-12 15:55:00', 6);
        $item_lost56->place_lost = 'Track and Field Bleachers';
        $item_lost56->image_url = $imgBase . 'Pink+Water+Bottle';
        $item_lost56->save();

        $item_lost57 = new ItemLost();
        $item_lost57->item_id = 7; // Repeat of Item ID 7
        $item_lost57->description = "Notes for a Latin course, handwritten.";
        $item_lost57->date_lost = $shiftDate('2024-11-05 08:35:00', 6);
        $item_lost57->place_lost = 'Foreign Language Department Lounge';
        $item_lost57->image_url = $imgBase . 'Latin+Notes';
        $item_lost57->save();

        $item_lost58 = new ItemLost();
        $item_lost58->item_id = 8; // Repeat of Item ID 8
        $item_lost58->description = "A single black Samsung Galaxy Bud (right side).";
        $item_lost58->date_lost = $shiftDate('2025-04-18 19:40:00', 6);
        $item_lost58->place_lost = 'Main Quad Grass';
        $item_lost58->image_url = $imgBase . 'Black+Galaxy+Bud';
        $item_lost58->save();

        $item_lost59 = new ItemLost();
        $item_lost59->item_id = 9; // Repeat of Item ID 9
        $item_lost59->description = "A black leather key fob with two small keys.";
        $item_lost59->date_lost = $shiftDate('2025-07-03 12:00:00', 6);
        $item_lost59->place_lost = 'Near the security office door';
        $item_lost59->image_url = $imgBase . 'Black+Key+Fob';
        $item_lost59->save();

        $item_lost60 = new ItemLost();
        $item_lost60->item_id = 10; // Repeat of Item ID 10
        $item_lost60->description = "A local city bus pass (monthly).";
        $item_lost60->date_lost = $shiftDate('2025-01-20 13:10:00', 6);
        $item_lost60->place_lost = 'Bus Stop on Elm Street';
        $item_lost60->image_url = $imgBase . 'City+Bus+Pass';
        $item_lost60->save();

        // =============================================
        // ITEMS 61-100: TAKEN (40% - taken = 1)
        // 'taken', 'date_taken', and 'user_taken_id' fields are included.
        // =============================================

        // --- ITEMS 61-80 (Original Dates, taken = 1) ---

        $item_lost61 = new ItemLost();
        $item_lost61->item_id = 11; 
        $item_lost61->description = "A grey zippered hoodie, size large, with the university logo on the chest.";
        $item_lost61->date_lost = '2025-03-05 17:50:00';
        $item_lost61->place_lost = 'The benches outside the dining hall';
        $item_lost61->image_url = $imgBase . 'Grey+University+Hoodie';
        $item_lost61->taken = 1;
        $item_lost61->date_taken = $getTakenDate($item_lost61->date_lost);
        $item_lost61->user_taken_id = $getUser();
        $item_lost61->save();

        $item_lost62 = new ItemLost();
        $item_lost62->item_id = 12; 
        $item_lost62->description = "A black knitted winter glove, right hand only.";
        $item_lost62->date_lost = '2025-01-08 07:40:00';
        $item_lost62->place_lost = 'Patterson Hall 4th floor stairwell';
        $item_lost62->image_url = $imgBase . 'Black+Knit+Glove';
        $item_lost62->taken = 1;
        $item_lost62->date_taken = $getTakenDate($item_lost62->date_lost);
        $item_lost62->user_taken_id = $getUser();
        $item_lost62->save();

        $item_lost63 = new ItemLost();
        $item_lost63->item_id = 13; 
        $item_lost63->description = "A small brass key stamped with the number '42B'.";
        $item_lost63->date_lost = '2024-12-19 14:00:00';
        $item_lost63->place_lost = 'Basement lockers near the swimming pool';
        $item_lost63->image_url = $imgBase . 'Locker+Key+42B';
        $item_lost63->taken = 1;
        $item_lost63->date_taken = $getTakenDate($item_lost63->date_lost);
        $item_lost63->user_taken_id = $getUser();
        $item_lost63->save();

        $item_lost64 = new ItemLost();
        $item_lost64->item_id = 14; 
        $item_lost64->description = "Black Sony over-the-ear noise-cancelling headphones in a soft case.";
        $item_lost64->date_lost = '2025-06-28 20:15:00';
        $item_lost64->place_lost = 'The quiet study area in the law school building';
        $item_lost64->image_url = $imgBase . 'Sony+Headphones';
        $item_lost64->taken = 1;
        $item_lost64->date_taken = $getTakenDate($item_lost64->date_lost);
        $item_lost64->user_taken_id = $getUser();
        $item_lost64->save();

        $item_lost65 = new ItemLost();
        $item_lost65->item_id = 15; 
        $item_lost65->description = "A thick wool beanie, maroon color.";
        $item_lost65->date_lost = '2025-02-14 10:50:00';
        $item_lost65->place_lost = 'Outside the main lecture theatre (Room 200)';
        $item_lost65->image_url = $imgBase . 'Maroon+Beanie+Hat';
        $item_lost65->taken = 1;
        $item_lost65->date_taken = $getTakenDate($item_lost65->date_lost);
        $item_lost65->user_taken_id = $getUser();
        $item_lost65->save();
        
        $item_lost66 = new ItemLost();
        $item_lost66->item_id = 16; 
        $item_lost66->description = "Thin silver-rimmed reading glasses, prescription -1.5.";
        $item_lost66->date_lost = '2025-09-01 16:25:00';
        $item_lost66->place_lost = 'In a textbook in the Art History room';
        $item_lost66->image_url = $imgBase . 'Silver+Reading+Glasses';
        $item_lost66->taken = 1;
        $item_lost66->date_taken = $getTakenDate($item_lost66->date_lost);
        $item_lost66->user_taken_id = $getUser();
        $item_lost66->save();

        $item_lost67 = new ItemLost();
        $item_lost67->item_id = 17; 
        $item_lost67->description = "Two simple house keys on a small ring with a blue plastic tag.";
        $item_lost67->date_lost = '2024-10-09 11:00:00';
        $item_lost67->place_lost = 'Main parking lot, near row K';
        $item_lost67->image_url = $imgBase . 'House+Keys+Blue+Tag';
        $item_lost67->taken = 1;
        $item_lost67->date_taken = $getTakenDate($item_lost67->date_lost);
        $item_lost67->user_taken_id = $getUser();
        $item_lost67->save();

        $item_lost68 = new ItemLost();
        $item_lost68->item_id = 18; 
        $item_lost68->description = "A black, collapsible umbrella with a wooden handle.";
        $item_lost68->date_lost = '2025-04-29 13:40:00';
        $item_lost68->place_lost = 'The umbrella stand outside the faculty center';
        $item_lost68->image_url = $imgBase . 'Black+Umbrella';
        $item_lost68->taken = 1;
        $item_lost68->date_taken = $getTakenDate($item_lost68->date_lost);
        $item_lost68->user_taken_id = $getUser();
        $item_lost68->save();

        $item_lost69 = new ItemLost();
        $item_lost69->item_id = 19; 
        $item_lost69->description = "A bright yellow, waterproof cover for a medium-sized backpack.";
        $item_lost69->date_lost = '2024-09-15 15:10:00';
        $item_lost69->place_lost = 'On the steps leading to the Engineering building';
        $item_lost69->image_url = $imgBase . 'Yellow+Rain+Cover';
        $item_lost69->taken = 1;
        $item_lost69->date_taken = $getTakenDate($item_lost69->date_lost);
        $item_lost69->user_taken_id = $getUser();
        $item_lost69->save();

        $item_lost70 = new ItemLost();
        $item_lost70->item_id = 20; 
        $item_lost70->description = "A simple digital wristwatch with a faded black rubber strap.";
        $item_lost70->date_lost = '2025-03-22 09:05:00';
        $item_lost70->place_lost = 'Lost near the water fountain on the quad';
        $item_lost70->image_url = $imgBase . 'Black+Digital+Watch';
        $item_lost70->taken = 1;
        $item_lost70->date_taken = $getTakenDate($item_lost70->date_lost);
        $item_lost70->user_taken_id = $getUser();
        $item_lost70->save();

        $item_lost71 = new ItemLost();
        $item_lost71->item_id = 21; 
        $item_lost71->description = "A Visa debit card from 'City Bank', name clearly visible.";
        $item_lost71->date_lost = '2025-05-17 14:00:00';
        $item_lost71->place_lost = 'Dropped near the ATM outside the Student Center';
        $item_lost71->image_url = $imgBase . 'Visa+Debit+Card';
        $item_lost71->taken = 1;
        $item_lost71->date_taken = $getTakenDate($item_lost71->date_lost);
        $item_lost71->user_taken_id = $getUser();
        $item_lost71->save();

        $item_lost72 = new ItemLost();
        $item_lost72->item_id = 22; 
        $item_lost72->description = "A small, worn, zippered coin pouch made of blue canvas.";
        $item_lost72->date_lost = '2025-01-30 18:20:00';
        $item_lost72->place_lost = 'Table 5 in the campus coffee shop';
        $item_lost72->image_url = $imgBase . 'Blue+Coin+Pouch';
        $item_lost72->taken = 1;
        $item_lost72->date_taken = $getTakenDate($item_lost72->date_lost);
        $item_lost72->user_taken_id = $getUser();
        $item_lost72->save();

        $item_lost73 = new ItemLost();
        $item_lost73->item_id = 23; 
        $item_lost73->description = "A brown leather bi-fold wallet containing student ID and cash.";
        $item_lost73->date_lost = '2024-11-28 11:30:00';
        $item_lost73->place_lost = 'Left on the radiator in the History lecture hall';
        $item_lost73->image_url = $imgBase . 'Brown+Leather+Wallet';
        $item_lost73->taken = 1;
        $item_lost73->date_taken = $getTakenDate($item_lost73->date_lost);
        $item_lost73->user_taken_id = $getUser();
        $item_lost73->save();

        $item_lost74 = new ItemLost();
        $item_lost74->item_id = 24; 
        $item_lost74->description = "A standard state driver's license (no wallet attached).";
        $item_lost74->date_lost = '2025-02-09 13:50:00';
        $item_lost74->place_lost = 'On the ground near the bicycle racks';
        $item_lost74->image_url = $imgBase . 'Drivers+License';
        $item_lost74->taken = 1;
        $item_lost74->date_taken = $getTakenDate($item_lost74->date_lost);
        $item_lost74->user_taken_id = $getUser();
        $item_lost74->save();

        $item_lost75 = new ItemLost();
        $item_lost75->item_id = 25; 
        $item_lost75->description = "A weekly public bus pass for the current month.";
        $item_lost75->date_lost = '2025-07-19 09:30:00';
        $item_lost75->place_lost = 'Outside the main library entrance';
        $item_lost75->image_url = $imgBase . 'Weekly+Transit+Pass';
        $item_lost75->taken = 1;
        $item_lost75->date_taken = $getTakenDate($item_lost75->date_lost);
        $item_lost75->user_taken_id = $getUser();
        $item_lost75->save();

        $item_lost76 = new ItemLost();
        $item_lost76->item_id = 26; 
        $item_lost76->description = "A black plastic charging case for wireless earbuds (empty).";
        $item_lost76->date_lost = '2025-08-08 17:00:00';
        $item_lost76->place_lost = 'Under a chair in the Computer Lab, Room 305';
        $item_lost76->image_url = $imgBase . 'Black+Earbud+Case';
        $item_lost76->taken = 1;
        $item_lost76->date_taken = $getTakenDate($item_lost76->date_lost);
        $item_lost76->user_taken_id = $getUser();
        $item_lost76->save();

        $item_lost77 = new ItemLost();
        $item_lost77->item_id = 27; 
        $item_lost77->description = "A small bottle of cherry-scented hand sanitizer with a pink clip.";
        $item_lost77->date_lost = '2024-12-01 12:45:00';
        $item_lost77->place_lost = 'Left on the window sill in the gymnasium hallway';
        $item_lost77->image_url = $imgBase . 'Cherry+Sanitizer';
        $item_lost77->taken = 1;
        $item_lost77->date_taken = $getTakenDate($item_lost77->date_lost);
        $item_lost77->user_taken_id = $getUser();
        $item_lost77->save();

        $item_lost78 = new ItemLost();
        $item_lost78->item_id = 28; 
        $item_lost78->description = "An empty orange prescription bottle labeled for a specific name.";
        $item_lost78->date_lost = '2025-04-04 15:30:00';
        $item_lost78->place_lost = 'Near the recycling bins in the common area';
        $item_lost78->image_url = $imgBase . 'Orange+Pill+Bottle';
        $item_lost78->taken = 1;
        $item_lost78->date_taken = $getTakenDate($item_lost78->date_lost);
        $item_lost78->user_taken_id = $getUser();
        $item_lost78->save();

        $item_lost79 = new ItemLost();
        $item_lost79->item_id = 29; 
        $item_lost79->description = "A black electronic car key fob for a Honda.";
        $item_lost79->date_lost = '2025-06-11 10:10:00';
        $item_lost79->place_lost = 'In the elevator of the administration building';
        $item_lost79->image_url = $imgBase . 'Honda+Car+Fob';
        $item_lost79->taken = 1;
        $item_lost79->date_taken = $getTakenDate($item_lost79->date_lost);
        $item_lost79->user_taken_id = $getUser();
        $item_lost79->save();

        $item_lost80 = new ItemLost();
        $item_lost80->item_id = 30; 
        $item_lost80->description = "One piece of small jewelry.";
        $item_lost80->date_lost = '2024-08-20 19:30:00';
        $item_lost80->place_lost = 'Found on the carpet near the theater stage';
        $item_lost80->image_url = $imgBase . 'Silver+Blue+Earring';
        $item_lost80->taken = 1;
        $item_lost80->date_taken = $getTakenDate($item_lost80->date_lost);
        $item_lost80->user_taken_id = $getUser();
        $item_lost80->save();


        // --- ITEMS 81-100 (Shifted Dates, taken = 1) ---

        $item_lost81 = new ItemLost();
        $item_lost81->item_id = 31; // Repeat of Item ID 31
        $item_lost81->description = "A large A4 wire-bound sketchbook with graphite pencil drawings inside.";
        $item_lost81->date_lost = $shiftDate('2025-03-28 14:15:00', 6);
        $item_lost81->place_lost = 'Left on an easel in the Art Studio';
        $item_lost81->image_url = $imgBase . 'A4+Sketchbook+B';
        $item_lost81->taken = 1;
        $item_lost81->date_taken = $getTakenDate($item_lost81->date_lost);
        $item_lost81->user_taken_id = $getUser();
        $item_lost81->save();

        $item_lost82 = new ItemLost();
        $item_lost82->item_id = 32; // Repeat of Item ID 32
        $item_lost82->description = "Clear protective lab goggles with an adjustable elastic strap.";
        $item_lost82->date_lost = $shiftDate('2024-10-25 08:50:00', 6);
        $item_lost82->place_lost = 'On the counter of Chemistry Lab 403';
        $item_lost82->image_url = $imgBase . 'Lab+Goggles+B';
        $item_lost82->taken = 1;
        $item_lost82->date_taken = $getTakenDate($item_lost82->date_lost);
        $item_lost82->user_taken_id = $getUser();
        $item_lost82->save();

        $item_lost83 = new ItemLost();
        $item_lost83->item_id = 33; // Repeat of Item ID 33
        $item_lost83->description = "A clear plastic container holding about 10 assorted guitar picks.";
        $item_lost83->date_lost = $shiftDate('2025-07-22 17:35:00', 6);
        $item_lost83->place_lost = 'In the Music Practice Room 7';
        $item_lost83->image_url = $imgBase . 'Guitar+Picks+B';
        $item_lost83->taken = 1;
        $item_lost83->date_taken = $getTakenDate($item_lost83->date_lost);
        $item_lost83->user_taken_id = $getUser();
        $item_lost83->save();

        $item_lost84 = new ItemLost();
        $item_lost84->item_id = 34; // Repeat of Item ID 34
        $item_lost84->description = "An unexposed roll of Kodak 35mm photographic film.";
        $item_lost84->date_lost = $shiftDate('2025-01-13 10:00:00', 6);
        $item_lost84->place_lost = 'Left on a table in the Photography Darkroom';
        $item_lost84->image_url = $imgBase . 'Roll+of+35mm+Film+B';
        $item_lost84->taken = 1;
        $item_lost84->date_taken = $getTakenDate($item_lost84->date_lost);
        $item_lost84->user_taken_id = $getUser();
        $item_lost84->save();

        $item_lost85 = new ItemLost();
        $item_lost85->item_id = 35; // Repeat of Item ID 35
        $item_lost85->description = "A large Spanish-English dictionary, well-used with a broken spine.";
        $item_lost85->date_lost = $shiftDate('2024-09-02 14:00:00', 6);
        $item_lost85->place_lost = 'The Language Learning Center, near computer station 4';
        $item_lost85->image_url = $imgBase . 'Spanish+Dictionary+B';
        $item_lost85->taken = 1;
        $item_lost85->date_taken = $getTakenDate($item_lost85->date_lost);
        $item_lost85->user_taken_id = $getUser();
        $item_lost85->save();

        $item_lost86 = new ItemLost();
        $item_lost86->item_id = 36; // Repeat of Item ID 36
        $item_lost86->description = "A dark green fountain pen with a gold nib, engraved initials 'A.R.'";
        $item_lost86->date_lost = $shiftDate('2025-05-09 13:05:00', 6);
        $item_lost86->place_lost = 'Found on the podium in the main auditorium';
        $item_lost86->image_url = $imgBase . 'Green+Fountain+Pen+B';
        $item_lost86->taken = 1;
        $item_lost86->date_taken = $getTakenDate($item_lost86->date_lost);
        $item_lost86->user_taken_id = $getUser();
        $item_lost86->save();

        $item_lost87 = new ItemLost();
        $item_lost87->item_id = 37; // Repeat of Item ID 37
        $item_lost87->description = "A large white ceramic coffee mug with a picture of a cat on it.";
        $item_lost87->date_lost = $shiftDate('2025-08-15 09:40:00', 6);
        $item_lost87->place_lost = 'Next to the campus coffee machine';
        $item_lost87->image_url = $imgBase . 'Cat+Coffee+Mug+B';
        $item_lost87->taken = 1;
        $item_lost87->date_taken = $getTakenDate($item_lost87->date_lost);
        $item_lost87->user_taken_id = $getUser();
        $item_lost87->save();

        $item_lost88 = new ItemLost();
        $item_lost88->item_id = 38; // Repeat of Item ID 38
        $item_lost88->description = "A United States passport, found open on the floor.";
        $item_lost88->date_lost = $shiftDate('2024-11-19 16:30:00', 6);
        $item_lost88->place_lost = 'The International Student Services office';
        $item_lost88->image_url = $imgBase . 'Passport+Document+B';
        $item_lost88->taken = 1;
        $item_lost88->date_taken = $getTakenDate($item_lost88->date_lost);
        $item_lost88->user_taken_id = $getUser();
        $item_lost88->save();

        $item_lost89 = new ItemLost();
        $item_lost89->item_id = 39; // Repeat of Item ID 39
        $item_lost89->description = "A small, black, cylindrical JBL portable Bluetooth speaker.";
        $item_lost89->date_lost = $shiftDate('2025-02-01 21:00:00', 6);
        $item_lost89->place_lost = 'Left on the floor in the campus gym weight room';
        $item_lost89->image_url = $imgBase . 'JBL+Bluetooth+Speaker+B';
        $item_lost89->taken = 1;
        $item_lost89->date_taken = $getTakenDate($item_lost89->date_lost);
        $item_lost89->user_taken_id = $getUser();
        $item_lost89->save();

        $item_lost90 = new ItemLost();
        $item_lost90->item_id = 40; // Repeat of Item ID 40
        $item_lost90->description = "A single, slightly scuffed yellow tennis ball.";
        $item_lost90->date_lost = $shiftDate('2025-06-03 14:00:00', 6);
        $item_lost90->place_lost = 'Found in the grassy area near the athletic fields';
        $item_lost90->image_url = $imgBase . 'Yellow+Tennis+Ball+B';
        $item_lost90->taken = 1;
        $item_lost90->date_taken = $getTakenDate($item_lost90->date_lost);
        $item_lost90->user_taken_id = $getUser();
        $item_lost90->save();

        $item_lost91 = new ItemLost();
        $item_lost91->item_id = 41; // Repeat of Item ID 41
        $item_lost91->description = "A stack of five printed resumes for a Finance major.";
        $item_lost91->date_lost = $shiftDate('2025-03-12 11:30:00', 6);
        $item_lost91->place_lost = 'Career Fair table 12';
        $item_lost91->image_url = $imgBase . 'Stack+of+Resumes+B';
        $item_lost91->taken = 1;
        $item_lost91->date_taken = $getTakenDate($item_lost91->date_lost);
        $item_lost91->user_taken_id = $getUser();
        $item_lost91->save();

        $item_lost92 = new ItemLost();
        $item_lost92->item_id = 42; // Repeat of Item ID 42
        $item_lost92->description = "A small, white box containing business cards from a local tech company.";
        $item_lost92->date_lost = $shiftDate('2025-04-20 15:00:00', 6);
        $item_lost92->place_lost = 'The lounge area of the Business School building';
        $item_lost92->image_url = $imgBase . 'Business+Cards+B';
        $item_lost92->taken = 1;
        $item_lost92->date_taken = $getTakenDate($item_lost92->date_lost);
        $item_lost92->user_taken_id = $getUser();
        $item_lost92->save();

        $item_lost93 = new ItemLost();
        $item_lost93->item_id = 43; // Repeat of Item ID 43
        $item_lost93->description = "A full pad of yellow square sticky notes.";
        $item_lost93->date_lost = $shiftDate('2025-01-01 09:00:00', 6);
        $item_lost93->place_lost = 'Left on a whiteboard in a study room';
        $item_lost93->image_url = $imgBase . 'Yellow+Sticky+Notes+B';
        $item_lost93->taken = 1;
        $item_lost93->date_taken = $getTakenDate($item_lost93->date_lost);
        $item_lost93->user_taken_id = $getUser();
        $item_lost93->save();

        $item_lost94 = new ItemLost();
        $item_lost94->item_id = 44; // Repeat of Item ID 44
        $item_lost94->description = "A black, external 1TB portable hard drive with a USB cable.";
        $item_lost94->date_lost = $shiftDate('2024-12-10 16:45:00', 6);
        $item_lost94->place_lost = 'Found on a desk in the Computer Science department';
        $item_lost94->image_url = $imgBase . 'External+Hard+Drive+B';
        $item_lost94->taken = 1;
        $item_lost94->date_taken = $getTakenDate($item_lost94->date_lost);
        $item_lost94->user_taken_id = $getUser();
        $item_lost94->save();

        $item_lost95 = new ItemLost();
        $item_lost95->item_id = 45; // Repeat of Item ID 45
        $item_lost95->description = "A small, red, plastic desk stapler.";
        $item_lost95->date_lost = $shiftDate('2025-05-29 11:50:00', 6);
        $item_lost95->place_lost = 'The copy machine area in the administrative offices';
        $item_lost95->image_url = $imgBase . 'Red+Office+Stapler+B';
        $item_lost95->taken = 1;
        $item_lost95->date_taken = $getTakenDate($item_lost95->date_lost);
        $item_lost95->user_taken_id = $getUser();
        $item_lost95->save();

        $item_lost96 = new ItemLost();
        $item_lost96->item_id = 46; // Repeat of Item ID 46
        $item_lost96->description = "A clear plastic pencil pouch containing two pens and a ruler.";
        $item_lost96->date_lost = $shiftDate('2024-10-05 13:00:00', 6);
        $item_lost96->place_lost = 'Found under a seat in Auditorium B';
        $item_lost96->image_url = $imgBase . 'Clear+Pencil+Pouch+B';
        $item_lost96->taken = 1;
        $item_lost96->date_taken = $getTakenDate($item_lost96->date_lost);
        $item_lost96->user_taken_id = $getUser();
        $item_lost96->save();

        $item_lost97 = new ItemLost();
        $item_lost97->item_id = 47; // Repeat of Item ID 47
        $item_lost97->description = "A $25 gift card for the campus coffee shop.";
        $item_lost97->date_lost = $shiftDate('2025-02-20 12:00:00', 6);
        $item_lost97->place_lost = 'Near the cash register at the coffee shop';
        $item_lost97->image_url = $imgBase . 'Coffee+Shop+Gift+Card+B';
        $item_lost97->taken = 1;
        $item_lost97->date_taken = $getTakenDate($item_lost97->date_lost);
        $item_lost97->user_taken_id = $getUser();
        $item_lost97->save();

        $item_lost98 = new ItemLost();
        $item_lost98->item_id = 48; // Repeat of Item ID 48
        $item_lost98->description = "A paper list titled 'Volunteers for Spring Festival' with 15 names.";
        $item_lost98->date_lost = $shiftDate('2025-07-07 10:30:00', 6);
        $item_lost98->place_lost = 'Taped to a bulletin board outside the Student Activities Center';
        $item_lost98->image_url = $imgBase . 'Volunteer+Sign-up+Sheet+B';
        $item_lost98->taken = 1;
        $item_lost98->date_taken = $getTakenDate($item_lost98->date_lost);
        $item_lost98->user_taken_id = $getUser();
        $item_lost98->save();

        $item_lost99 = new ItemLost();
        $item_lost99->item_id = 49; // Repeat of Item ID 49
        $item_lost99->description = "A single black dry-erase marker (thick tip).";
        $item_lost99->date_lost = $shiftDate('2025-03-01 15:40:00', 6);
        $item_lost99->place_lost = 'On the ledge of the whiteboard in Seminar Room 7';
        $item_lost99->image_url = $imgBase . 'Black+Dry+Erase+Marker+B';
        $item_lost99->taken = 1;
        $item_lost99->date_taken = $getTakenDate($item_lost99->date_lost);
        $item_lost99->user_taken_id = $getUser();
        $item_lost99->save();

        $item_lost100 = new ItemLost();
        $item_lost100->item_id = 50; // Repeat of Item ID 50
        $item_lost100->description = "A silver 10,000mAh portable battery charger.";
        $item_lost100->date_lost = $shiftDate('2024-09-25 18:00:00', 6);
        $item_lost100->place_lost = 'Left charging on an outlet in the public lounge';
        $item_lost100->image_url = $imgBase . 'Silver+Power+Bank+B';
        $item_lost100->taken = 1;
        $item_lost100->date_taken = $getTakenDate($item_lost100->date_lost);
        $item_lost100->user_taken_id = $getUser();
        $item_lost100->save();
    }
}
