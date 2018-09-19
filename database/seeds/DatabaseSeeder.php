<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\Division;
use App\District;
use App\Category;
use App\Brand;
use App\PaymentMethod;

class DatabaseSeeder extends Seeder {

	public function run()
	{
		$this->call('AdminTableSeeder');
		$this->command->info('Admin table seeded!');


		$this->call('DivisionTableSeeder');
		$this->command->info('Division table seeded!');

		$this->call('DistrictTableSeeder');
		$this->command->info('District table seeded!');

		$this->call('UpazillaTableSeeder');
		$this->command->info('Upazilla table seeded!');

		$this->call('CategoryTableSeeder');
		$this->command->info('Category table seeded!');

		$this->call('BrandTableSeeder');
		$this->command->info('Brand table seeded!');

		$this->call('PaymentMethodsTableSeeder');
		$this->command->info('PaymentMethods table seeded!');

	}

}

class AdminTableSeeder extends Seeder {

	public function run()
	{
		DB::table('admins')->delete();
		$admins = [
			[
				'name' 				=> 'Admin',
				'email' 			=> 'admin@example.com',
				'password' 			=> Hash::make('123456'),
				'type' 				=> 'Super Admin',
			],

			[
				'name' 				=> 'Maniruzzaman Akash',
				'email' 			=> 'manirujjamanakash@gmail.com',
				'password' 			=> Hash::make('123456'),
				'type' 				=> 'Super Admin',
			]
		];

		Admin::insert($admins);
	}

}

class DivisionTableSeeder extends Seeder {

	public function run()
	{
		DB::table('divisions')->delete();

		$divisions = [
			['id' => 1, 'name' => 'Dhaka', 'slug' => 'dhaka', 'order'	=> 1, 'image' => 'Dhaka.png'],
			['id' => 2, 'name' => 'Mymensingh', 'slug' => 'mymensingh', 'order'	=> 2, 'image' => 'mymensingh.png'],
			['id' => 3, 'name' => 'Rajshahi', 'slug' => 'rajshahi', 'order'	=> 3, 'image' => 'rajshahi.png'],
			['id' => 4, 'name' => 'Khulna', 'slug' => 'khulna', 'order'	=> 4, 'image' => 'khulna.png'],
			['id' => 5, 'name' => 'Barisal', 'slug' => 'barisal', 'order'	=> 5, 'image' => 'barisal.png'],
			['id' => 6, 'name' => 'Sylhet', 'slug' => 'sylhet', 'order'	=> 6, 'image' => 'sylhet.png'],
			['id' => 7, 'name' => 'Chittagong', 'slug' => 'chittagong', 'order'	=> 7, 'image' => 'chittagong.png'],
			['id' => 8, 'name' => 'Rangpur', 'slug' => 'rangpur', 'order'	=> 8, 'image' => 'rangpur.png'],
		];

		Division::insert($divisions);

	}

}


class DistrictTableSeeder extends Seeder {

	public function run()
	{
		DB::table('districts')->delete();

		$districts = [

			// Dhaka Division District =  13
			['id' => 1, 'name' => 'Dhaka', 'slug' => 'dhaka', 'division_id' => 1],
			['id' => 2, 'name' => 'Gajipur', 'slug' => 'gajipur', 'division_id' => 1],
			['id' => 3, 'name' => 'Kishorganj', 'slug' => 'kishorganj', 'division_id' => 1],
			['id' => 4, 'name' => 'Gopalganj', 'slug' => 'gopalganj', 'division_id' => 1],
			['id' => 5, 'name' => 'Norshingdi', 'slug' => 'norshingdi', 'division_id' => 1],
			['id' => 6, 'name' => 'Narayonganj', 'slug' => 'narayonganj', 'division_id' => 1],
			['id' => 7, 'name' => 'Faridpur', 'slug' => 'faridpur', 'division_id' => 1],
			['id' => 8, 'name' => 'Madaripur', 'slug' => 'madaripur', 'division_id' => 1],
			['id' => 9, 'name' => 'Manikganj', 'slug' => 'manikganj', 'division_id' => 1],
			['id' => 10, 'name' => 'Munsiganj', 'slug' => 'munsiganj', 'division_id' => 1],
			['id' => 11, 'name' => 'Rajbari', 'slug' => 'rajbari', 'division_id' => 1],
			['id' => 12, 'name' => 'Shariotpur', 'slug' => 'shariotpur', 'division_id' => 1],
			['id' => 13, 'name' => 'Tangail', 'slug' => 'tangail', 'division_id' => 1],

			// Mymensingh Division Districts = 4
			['id' => 14, 'name' => 'Mymensingh', 'slug' => 'mymensingh',  'division_id' => 2],
			['id' => 15, 'name' => 'Jamalpur', 'slug' => 'jamalpur',  'division_id' => 2],
			['id' => 16, 'name' => 'Netrokona', 'slug' => 'netrokona',  'division_id' => 2],
			['id' => 17, 'name' => 'Sherpur', 'slug' => 'sherpur',  'division_id' => 2],

			// Rajshahi Division Districts = 8
			['id' => 18, 'name' => 'Rajshahi', 'slug' => 'Rajshahi',  'division_id' => 3],
			['id' => 19, 'name' => 'Bogra', 'slug' => 'Bogra',  'division_id' => 3],
			['id' => 20, 'name' => 'Joypurhat', 'slug' => 'Joypurhat',  'division_id' => 3],
			['id' => 21, 'name' => 'Naogaon', 'slug' => 'Naogaon',  'division_id' => 3],
			['id' => 22, 'name' => 'Natore', 'slug' => 'Natore',  'division_id' => 3],
			['id' => 23, 'name' => 'Chapai Nawabganj', 'slug' => 'Chapai-nawabganj',  'division_id' => 3],
			['id' => 24, 'name' => 'Pabna', 'slug' => 'Pabna',  'division_id' => 3],
			['id' => 25, 'name' => 'Sirajganj', 'slug' => 'Sirajganj',  'division_id' => 3],

			// Khulna Division Districts = 10
			['id' => 26, 'name' => 'Khulna', 'slug' => 'Khulna',  'division_id' => 4],
			['id' => 27, 'name' => 'Bagerhat', 'slug' => 'Bagerhat',  'division_id' => 4],
			['id' => 28, 'name' => 'Chuadanga', 'slug' => 'Chuadanga',  'division_id' => 4],
			['id' => 29, 'name' => 'Jessore', 'slug' => 'Jessore',  'division_id' => 4],
			['id' => 30, 'name' => 'Kushtia', 'slug' => 'Kushtia',  'division_id' => 4],
			['id' => 31, 'name' => 'Magura', 'slug' => 'Magura',  'division_id' => 4],
			['id' => 32, 'name' => 'Meherpur', 'slug' => 'Meherpur',  'division_id' => 4],
			['id' => 33, 'name' => 'Narail', 'slug' => 'Narail',  'division_id' => 4],
			['id' => 34, 'name' => 'Satkhira', 'slug' => 'Satkhira',  'division_id' => 4],
			['id' => 35, 'name' => 'Jhenaidah', 'slug' => 'Jhenaidah',  'division_id' => 4],

			//Barisal Division District = 6
			['id' => 36, 'name' => 'Barisal', 'slug' => 'Barisal',  'division_id' => 5],
			['id' => 37, 'name' => 'Patuakhali', 'slug' => 'patuakhali',  'division_id' => 5],
			['id' => 38, 'name' => 'Jhalokathi', 'slug' => 'jhalokathi',  'division_id' => 5],
			['id' => 39, 'name' => 'Pirujpur', 'slug' => 'pirujpur',  'division_id' => 5],
			['id' => 40, 'name' => 'Barguna', 'slug' => 'barguna',  'division_id' => 5],
			['id' => 41, 'name' => 'Bhula', 'slug' => 'bhula',  'division_id' => 5],

			//Sylhet Division District = 4
			['id' => 42, 'name' => 'Sylhet', 'slug' => 'Sylhet',  'division_id' => 6],
			['id' => 43, 'name' => 'Habiganj', 'slug' => 'Habiganj',  'division_id' => 6],
			['id' => 44, 'name' => 'Moulvibazar', 'slug' => 'Moulvibazar',  'division_id' => 6],
			['id' => 45, 'name' => 'Sunamganj', 'slug' => 'Sunamganj',  'division_id' => 6],

			//Chittagong Division District = 11
			['id' => 46, 'name' => 'Chittagong', 'slug' => 'Chittagong',  'division_id' => 7],
			['id' => 47, 'name' => 'Bandarban', 'slug' => 'Bandarban',  'division_id' => 7],
			['id' => 48, 'name' => 'Brahmanbaria', 'slug' => 'Brahmanbaria',  'division_id' => 7],
			['id' => 49, 'name' => 'Comilla', 'slug' => 'Comilla',  'division_id' => 7],
			['id' => 50, 'name' => 'Cox\'s Bazar', 'slug' => 'Coxs-Bazar',  'division_id' => 7],
			['id' => 51, 'name' => 'Feni', 'slug' => 'Feni',  'division_id' => 7],
			['id' => 52, 'name' => 'Khagrachhari', 'slug' => 'Khagrachhari',  'division_id' => 7],
			['id' => 53, 'name' => 'Lakshmipur', 'slug' => 'Lakshmipur',  'division_id' => 7],
			['id' => 54, 'name' => 'Noakhali', 'slug' => 'Noakhali',  'division_id' => 7],
			['id' => 55, 'name' => 'Rangamati', 'slug' => 'Rangamati',  'division_id' => 7],
			['id' => 56, 'name' => 'Chandpur', 'slug' => 'Chandpur',  'division_id' => 7],

			//Rangpur Division District = 8
			['id' => 57, 'name' => 'Rangpur', 'slug' => 'Rangpur',  'division_id' => 8],
			['id' => 58, 'name' => 'Dinajpur', 'slug' => 'Dinajpur',  'division_id' => 8],
			['id' => 59, 'name' => 'Gaibandha', 'slug' => 'Gaibandha',  'division_id' => 8],
			['id' => 60, 'name' => 'Kurigram', 'slug' => 'Kurigram',  'division_id' => 8],
			['id' => 61, 'name' => 'Lalmonirhat', 'slug' => 'Lalmonirhat',  'division_id' => 8],
			['id' => 62, 'name' => 'Nilphamari', 'slug' => 'Nilphamari',  'division_id' => 8],
			['id' => 63, 'name' => 'Panchagarh', 'slug' => 'Panchagarh',  'division_id' => 8],
			['id' => 64, 'name' => 'Thakurgaon', 'slug' => 'Thakurgaon',  'division_id' => 8],

		];

		District::insert($districts);

	}

}

/**
 * UpazillaTableSeeder Class
 * -------------------------------
 * @src = https://en.wikipedia.org/wiki/Upazilas_of_Bangladesh
 */ 
class UpazillaTableSeeder extends Seeder {

	public function run()
	{
		DB::table('upazillas')->delete();

		$upazillas = [
			/**
			 * Dhaka Divisions
			 */

			//Dhaka District Upazillas
			['id' => 1, 'name' => 'Tejgaon', 'district_id' => 1],
			['id' => 2, 'name' => 'Dhamrai', 'district_id' => 1],
			['id' => 3, 'name' => 'Dohar', 'district_id' => 1],
			['id' => 4, 'name' => 'Nawabganj', 'district_id' => 1],
			['id' => 5, 'name' => 'Savar', 'district_id' => 1],
			['id' => 6, 'name' => 'Keraniganj', 'district_id' => 1],

			//Gajipur District Upazillas
			['id' => 7, 'name' => 'Gazipur Sadar', 'district_id' => 2],
			['id' => 8, 'name' => 'Kaliakair', 'district_id' => 2],
			['id' => 9, 'name' => 'Kaliganj', 'district_id' => 2],
			['id' => 10, 'name' => 'Kapasia', 'district_id' => 2],
			['id' => 11, 'name' => 'Sreepur', 'district_id' => 2],

			//Kishoreganj District Upazillas
			['id' => 12, 'name' => 'Austagram', 'district_id' => 3],
			['id' => 13, 'name' => 'Bajitpur', 'district_id' => 3],
			['id' => 14, 'name' => 'Bhairab', 'district_id' => 3],
			['id' => 15, 'name' => 'Hossainpur', 'district_id' => 3],
			['id' => 16, 'name' => 'Itna', 'district_id' => 3],
			['id' => 17, 'name' => 'Karimganj', 'district_id' => 3],
			['id' => 18, 'name' => 'Katiadi', 'district_id' => 3],
			['id' => 19, 'name' => 'Kishoreganj', 'district_id' => 3],
			['id' => 20, 'name' => 'Kuliarchar', 'district_id' => 3],
			['id' => 21, 'name' => 'Mithamain', 'district_id' => 3],
			['id' => 22, 'name' => 'Nikli', 'district_id' => 3],
			['id' => 23, 'name' => 'Pakundia', 'district_id' => 3],
			['id' => 24, 'name' => 'Tarail', 'district_id' => 3],

			//Gopalganj District Upazillas
			['id' => 25, 'name' => 'Gopalganj Sadar', 'district_id' => 4],
			['id' => 26, 'name' => 'Kashiani', 'district_id' => 4],
			['id' => 27, 'name' => 'Kotalipara', 'district_id' => 4],
			['id' => 28, 'name' => 'Muksudpur', 'district_id' => 4],
			['id' => 29, 'name' => 'Tungipara', 'district_id' => 4],



			/**
			 * Barisal Divisions
			 */

			//Barisal District Upazillas
			['id' => 30, 'name' => 'Barisal Sadar', 'district_id' => 36],
			['id' => 31, 'name' => 'Agailjhara', 'district_id' => 36],
			['id' => 32, 'name' => 'Babuganj', 'district_id' => 36],
			['id' => 33, 'name' => 'Bakerganj', 'district_id' => 36],
			['id' => 34, 'name' => 'Banaripara', 'district_id' => 36],
			['id' => 35, 'name' => 'Gaurnadi', 'district_id' => 36],
			['id' => 36, 'name' => 'Hizla', 'district_id' => 36],
			['id' => 37, 'name' => 'Mehendiganj', 'district_id' => 36],
			['id' => 38, 'name' => 'Muladi', 'district_id' => 36],
			['id' => 39, 'name' => 'Wazirpur', 'district_id' => 36],

			//Patuakhali Districts
			['id' => 40, 'name' => 'Patuakhali Sadar', 'district_id' => 37],
			['id' => 41, 'name' => 'Bauphal', 'district_id' => 37],
			['id' => 42, 'name' => 'Dashmina', 'district_id' => 37],
			['id' => 43, 'name' => 'Kalapara', 'district_id' => 37],
			['id' => 44, 'name' => 'Mirzaganj', 'district_id' => 37],
			['id' => 45, 'name' => 'Rangabali', 'district_id' => 37],
			['id' => 46, 'name' => 'Dumki', 'district_id' => 37],
			['id' => 47, 'name' => 'Galachipa', 'district_id' => 37],

			//Mymensingh District Upazillas
			['id' => 48, 'name' => 'Mymensingh Sadar', 'district_id' => 14],
			['id' => 49, 'name' => 'Bhaluka', 'district_id' => 14],
			['id' => 50, 'name' => 'Dhobaura', 'district_id' => 14],
			['id' => 51, 'name' => 'Fulbaria', 'district_id' => 14],
			['id' => 52, 'name' => 'Gaffargaon', 'district_id' => 14],
			['id' => 53, 'name' => 'Gauripur', 'district_id' => 14],
			['id' => 54, 'name' => 'Haluaghat', 'district_id' => 14],
			['id' => 55, 'name' => 'Ishwarganj', 'district_id' => 14],
			['id' => 56, 'name' => 'Muktagachha', 'district_id' => 14],
			['id' => 57, 'name' => 'Nandail', 'district_id' => 14],
			['id' => 58, 'name' => 'Phulpur', 'district_id' => 14],
			['id' => 59, 'name' => 'Trishal', 'district_id' => 14],
			['id' => 60, 'name' => 'Tara', 'district_id' => 14],

		];

		DB::table('upazillas')->insert($upazillas);

	}

}

class CategoryTableSeeder extends Seeder {

	public function run()
	{
		DB::table('categories')->delete();

		$category =
		[
			['id' => 1, 'name' => 'Motor Bike', 'slug' => 'motor-bike', 'image' => 'Motor-bike.png'],
			['id' => 2, 'name' => 'Electronics', 'slug' => 'electronics', 'image' => 'electronics.png'],
			['id' => 3, 'name' => 'Laptop', 'slug' => 'Laptop', 'image' => 'Laptop.png'],
			['id' => 4, 'name' => 'Car', 'slug' => 'Car', 'image' => 'Car.jpg'],
			['id' => 5, 'name' => 'Shirt', 'slug' => 'Shirt', 'image' => 'Shirt.png'],
			['id' => 6, 'name' => 'Pant', 'slug' => 'Pant', 'image' => 'Pant.png'],
			['id' => 7, 'name' => 'Mobile', 'slug' => 'Mobile', 'image' => 'Mobile.png'],
			['id' => 8, 'name' => 'Others', 'slug' => 'others', 'image' => 'others.png'],
		];

		Category::insert($category);

	}
}

class PaymentMethodsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('payment_methods')->delete();

		$payment_methods =
		[
			['id' => 1, 'name' => 'Bkash', 'image' => 'Bkash.jpg'],
			['id' => 2, 'name' => 'Dutch Bangla Bank', 'image' => 'Dutch-bangla.jpg'],
		];

		PaymentMethod::insert($payment_methods);

	}
}

class BrandTableSeeder extends Seeder {

	public function run()
	{
		DB::table('brands')->delete();

		$brands =
		[
			['id' => 1, 'name' => 'Apple', 'slug' => 'apple', 'image' => 'Apple.png'],
			['id' => 2, 'name' => 'Samsung', 'slug' => 'samsung', 'image' => 'Samsung.jpg'],
			['id' => 3, 'name' => 'Suzuki', 'slug' => 'Suzuki', 'image' => 'Suzuki.png'],
			['id' => 4, 'name' => 'Bajaj', 'slug' => 'Bajaj', 'image' => 'Bajaj.jpg'],
			['id' => 5, 'name' => 'Lenovo', 'slug' => 'Lenovo', 'image' => 'Lenovo.png'],
			['id' => 6, 'name' => 'Others', 'slug' => 'others', 'image' => 'Others.png'],
		];

		Brand::insert($brands);

	}
}
