<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
  
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

    $permissions = [
    'صفحة الادمن',
 
    'الاقسام',
    'اضافةقسم',
    'تعديل قسم',
    'حذف قسم',

    'المنتجات',
    'اضافةالمنتجات',
    'تعديل المنتجات',
    'حذف المنتجات',

    'العروض',
    'اضافةعرض',
    'تعديل عرض',
    'حذف عرض',

    'الطلبات',
    'قبول الطلبات',
    'رفض الطلبات',
    'اتمام الطلبات',
    'الطلبات المقبولة',
    'الطلبات المرفوضة',
    'الطلبات اللي تمت',

    'الصلاحيات المستخدمين',
    'اضافةالصلاحية',
    'عرض الصلاحية',
    'تعديل الصلاحية',
    'حذف الصلاحية',

    'المستخدمين',
    'اضافةالمستخدمين',
    'عرض المستخدمين',
    'تعديل المستخدمين',
    'حذف المستخدمين',
 

    ];
        
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}