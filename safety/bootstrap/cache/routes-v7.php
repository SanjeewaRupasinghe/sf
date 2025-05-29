<?php

/*
|--------------------------------------------------------------------------
| Load The Cached Routes
|--------------------------------------------------------------------------
|
| Here we will decode and unserialize the RouteCollection instance that
| holds all of the route information for an application. This allows
| us to instantaneously load the entire route map into the router.
|
*/

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/superadmin' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/edit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.edit',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.logout',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/blogCategory' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogCategory.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'blogCategory.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/blogCategory/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogCategory.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/checkSlug' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogCategory.checkSlug',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/blogPost' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogPost.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'blogPost.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/blogPost/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogPost.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/checkSlug2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogPost.checkSlug2',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/category' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'category.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'category.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/category/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'category.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/checkSlug3' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'category.checkSlug3',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/course' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'course.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'course.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/course/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'course.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/checkSlug4' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'course.checkSlug4',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/courseCalendar' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'courseCalendar.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'courseCalendar.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/courseCalendar/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'courseCalendar.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/image' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'image.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'image.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/image/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'image.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/apBlogCategory' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'apBlogCategory.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'apBlogCategory.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/apBlogCategory/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'apBlogCategory.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/checkSlug5' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'apBlogCategory.checkSlug5',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/apBlogPost' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'apBlogPost.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'apBlogPost.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/apBlogPost/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'apBlogPost.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/checkSlug6' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'apBlogPost.checkSlug6',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/apCategory' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'apCategory.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'apCategory.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/apCategory/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'apCategory.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/checkSlug7' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'apCategory.checkSlug7',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/apCourse' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'apCourse.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'apCourse.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/apCourse/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'apCourse.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/superadmin/checkSlug8' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'apCourse.checkSlug8',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/course' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/course/blogs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home.blogs',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/course/register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home.registerMail',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/course/contact' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home.contact',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'home.contactMail',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/course/findCourse' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home.findCourse',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/course/gallery' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home.gallery',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/course/paynow' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home.paynow',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/course/terms' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home.terms',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/course/privacy' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home.privacy',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/course/shipping' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home.shipping',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/course/refund' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home.refund',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/course/about' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home.about',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/course/career' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home.career',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/paynow' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home.paynowPost',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/response' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home.response',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'main.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/faq' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.faq',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/terms' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.terms',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/paynow' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.paynow',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/contact' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.contact',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.contactMail',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/blogs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.blogs',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.register.submit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.register',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/privacy' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.privacy',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/shipping' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.shipping',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/refund' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.refund',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/about' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.about',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/career' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.career',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/resend-otp' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.resendOtp',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/email-confirmation' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.emailConfirmation',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/email-confirmation-submit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.emailConfirmationSubmit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/password-reset' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.passwordReset',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/login-submit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.loginSubmit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/instructions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.instructions',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/personal-details' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.personal-details',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/personal-details-submit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.personal-details.submit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/scope-of-work' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.scope-of-work',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/scope-of-work-submit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.scope-of-work.submit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/annual-appraisals' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.annual-appraisals',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/annual-appraisals-submit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.annual-appraisals.submit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/development-plans' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.development-plans',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/development-plans-submit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.development-plans.submit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/cpd' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.cpd',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/cpd-submit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.cpd.submit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/quality-improvement' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.quality-improvement',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/quality-improvement-submit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.quality-improvement.submit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/significant-events' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.significant-events',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/significant-events-submit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.significant-events.submit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/feedback' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.feedback',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/feedback-submit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.feedback.submit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/complaints' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.complaints',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/complaints-submit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.complaints.submit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/achievements' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.achievements',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/achievements-submit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.achievements.submit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/probity' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.probity',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/probity-submit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.probity.submit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/additional-info' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.additional-info',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/additional-info-submit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.additional-info.submit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/supporting-info' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.supporting-info',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/gmc-domains' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.gmc-domains',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/gmc-domains-submit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.gmc-domains.submit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/checklist' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.checklist',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/checklist-submit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.checklist.submit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/personal-development-plan' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.development-plan',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/personal-development-plan-submit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.development-plan.submit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/summary' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.summary',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/summary-submit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.summary.submit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/outputs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.outputs',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/outputs-submit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.outputs.submit',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/user/completion' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.completion',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/appraisal/pdf}' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.completion.pdf',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/product' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'product.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/product/j-tip' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'product.jtip',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/product/victor' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'product.victor',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/product/terms' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'product.terms',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/product/paynow' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'product.paynow',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/product/contact' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'product.contact',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'product.contactMail',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/product/privacy' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'product.privacy',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/product/shipping' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'product.shipping',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/product/refund' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'product.refund',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/product/about' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'product.about',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/product/career' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'product.career',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/logs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::u1Bp8GOGw3CwN9pT',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::aJwnsU4aHa33BM0P',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/superadmin/(?|update/([^/]++)(*:37)|blog(?|Category/([^/]++)(?|(*:71)|/edit(*:83)|(*:90))|Post/([^/]++)(?|(*:114)|/edit(*:127)|(*:135)))|c(?|ategory/([^/]++)(?|(*:168)|/edit(*:181)|(*:189))|ourse(?|/([^/]++)(?|(*:218)|/edit(*:231)|(*:239))|Calendar/([^/]++)(?|(*:268)|/edit(*:281)|(*:289))))|image/([^/]++)(?|(*:317)|/edit(*:330)|(*:338))|ap(?|Blog(?|Category/([^/]++)(?|(*:379)|/edit(*:392)|(*:400))|Post/([^/]++)(?|(*:425)|/edit(*:438)|(*:446)))|C(?|ategory/([^/]++)(?|(*:479)|/edit(*:492)|(*:500))|ourse/([^/]++)(?|(*:526)|/edit(*:539)|(*:547)))))|/course/(?|switchlocale/([^/]++)(*:591)|c(?|alendar(?:/([^/]++)(?:/([^/]++))?)?(*:638)|ourse(?|s(?:/([^/]++))?(*:669)|/([^/]++)(*:686)))|blog/([^/]++)(*:709))|/appraisal/(?|blog/([^/]++)(*:745)|service(?|s(?:/([^/]++))?(*:778)|/([^/]++)(*:795))|user/file\\-download/([^/]++)(*:832)|pdf\\-download/([^/]++)(*:862)))/?$}sDu',
    ),
    3 => 
    array (
      37 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PATCH' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      71 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogCategory.show',
          ),
          1 => 
          array (
            0 => 'blogCategory',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      83 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogCategory.edit',
          ),
          1 => 
          array (
            0 => 'blogCategory',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      90 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogCategory.update',
          ),
          1 => 
          array (
            0 => 'blogCategory',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'blogCategory.destroy',
          ),
          1 => 
          array (
            0 => 'blogCategory',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      114 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogPost.show',
          ),
          1 => 
          array (
            0 => 'blogPost',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      127 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogPost.edit',
          ),
          1 => 
          array (
            0 => 'blogPost',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      135 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'blogPost.update',
          ),
          1 => 
          array (
            0 => 'blogPost',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'blogPost.destroy',
          ),
          1 => 
          array (
            0 => 'blogPost',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      168 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'category.show',
          ),
          1 => 
          array (
            0 => 'category',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      181 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'category.edit',
          ),
          1 => 
          array (
            0 => 'category',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      189 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'category.update',
          ),
          1 => 
          array (
            0 => 'category',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'category.destroy',
          ),
          1 => 
          array (
            0 => 'category',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      218 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'course.show',
          ),
          1 => 
          array (
            0 => 'course',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      231 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'course.edit',
          ),
          1 => 
          array (
            0 => 'course',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      239 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'course.update',
          ),
          1 => 
          array (
            0 => 'course',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'course.destroy',
          ),
          1 => 
          array (
            0 => 'course',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      268 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'courseCalendar.show',
          ),
          1 => 
          array (
            0 => 'courseCalendar',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      281 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'courseCalendar.edit',
          ),
          1 => 
          array (
            0 => 'courseCalendar',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      289 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'courseCalendar.update',
          ),
          1 => 
          array (
            0 => 'courseCalendar',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'courseCalendar.destroy',
          ),
          1 => 
          array (
            0 => 'courseCalendar',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      317 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'image.show',
          ),
          1 => 
          array (
            0 => 'image',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      330 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'image.edit',
          ),
          1 => 
          array (
            0 => 'image',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      338 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'image.update',
          ),
          1 => 
          array (
            0 => 'image',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'image.destroy',
          ),
          1 => 
          array (
            0 => 'image',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      379 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'apBlogCategory.show',
          ),
          1 => 
          array (
            0 => 'apBlogCategory',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      392 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'apBlogCategory.edit',
          ),
          1 => 
          array (
            0 => 'apBlogCategory',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      400 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'apBlogCategory.update',
          ),
          1 => 
          array (
            0 => 'apBlogCategory',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'apBlogCategory.destroy',
          ),
          1 => 
          array (
            0 => 'apBlogCategory',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      425 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'apBlogPost.show',
          ),
          1 => 
          array (
            0 => 'apBlogPost',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      438 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'apBlogPost.edit',
          ),
          1 => 
          array (
            0 => 'apBlogPost',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      446 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'apBlogPost.update',
          ),
          1 => 
          array (
            0 => 'apBlogPost',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'apBlogPost.destroy',
          ),
          1 => 
          array (
            0 => 'apBlogPost',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      479 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'apCategory.show',
          ),
          1 => 
          array (
            0 => 'apCategory',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      492 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'apCategory.edit',
          ),
          1 => 
          array (
            0 => 'apCategory',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      500 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'apCategory.update',
          ),
          1 => 
          array (
            0 => 'apCategory',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'apCategory.destroy',
          ),
          1 => 
          array (
            0 => 'apCategory',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      526 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'apCourse.show',
          ),
          1 => 
          array (
            0 => 'apCourse',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      539 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'apCourse.edit',
          ),
          1 => 
          array (
            0 => 'apCourse',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      547 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'apCourse.update',
          ),
          1 => 
          array (
            0 => 'apCourse',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'apCourse.destroy',
          ),
          1 => 
          array (
            0 => 'apCourse',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      591 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'locale.set',
          ),
          1 => 
          array (
            0 => 'locale',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      638 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home.calendar',
            'month' => NULL,
            'year' => NULL,
          ),
          1 => 
          array (
            0 => 'month',
            1 => 'year',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      669 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home.courses',
            'slug' => NULL,
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      686 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home.course',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      709 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home.blog',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      745 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.blog',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      778 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.courses',
            'slug' => NULL,
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      795 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.course',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      832 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.file.download',
          ),
          1 => 
          array (
            0 => 'fileName',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      862 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'appraisal.user.completion.download.pdf',
          ),
          1 => 
          array (
            0 => 'filename',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'admin.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\AdminController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\AdminController@index',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
        'as' => 'admin.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'superadmin/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\AdminController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\AdminController@store',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
        'as' => 'admin.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\AdminController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\AdminController@create',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
        'as' => 'admin.dashboard',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\AdminController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\AdminController@edit',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
        'as' => 'admin.edit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.logout' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\AdminController@logout',
        'controller' => 'App\\Http\\Controllers\\Admin\\AdminController@logout',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
        'as' => 'admin.logout',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.update' => 
    array (
      'methods' => 
      array (
        0 => 'PATCH',
      ),
      'uri' => 'superadmin/update/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\AdminController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\AdminController@update',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
        'as' => 'admin.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'blogCategory.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/blogCategory',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'blogCategory.index',
        'uses' => 'App\\Http\\Controllers\\Admin\\BlogCategoryController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\BlogCategoryController@index',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'blogCategory.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/blogCategory/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'blogCategory.create',
        'uses' => 'App\\Http\\Controllers\\Admin\\BlogCategoryController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\BlogCategoryController@create',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'blogCategory.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'superadmin/blogCategory',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'blogCategory.store',
        'uses' => 'App\\Http\\Controllers\\Admin\\BlogCategoryController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\BlogCategoryController@store',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'blogCategory.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/blogCategory/{blogCategory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'blogCategory.show',
        'uses' => 'App\\Http\\Controllers\\Admin\\BlogCategoryController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\BlogCategoryController@show',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'blogCategory.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/blogCategory/{blogCategory}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'blogCategory.edit',
        'uses' => 'App\\Http\\Controllers\\Admin\\BlogCategoryController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\BlogCategoryController@edit',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'blogCategory.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'superadmin/blogCategory/{blogCategory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'blogCategory.update',
        'uses' => 'App\\Http\\Controllers\\Admin\\BlogCategoryController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\BlogCategoryController@update',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'blogCategory.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'superadmin/blogCategory/{blogCategory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'blogCategory.destroy',
        'uses' => 'App\\Http\\Controllers\\Admin\\BlogCategoryController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\BlogCategoryController@destroy',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'blogCategory.checkSlug' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/checkSlug',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\BlogCategoryController@checkSlug',
        'controller' => 'App\\Http\\Controllers\\Admin\\BlogCategoryController@checkSlug',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
        'as' => 'blogCategory.checkSlug',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'blogPost.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/blogPost',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'blogPost.index',
        'uses' => 'App\\Http\\Controllers\\Admin\\BlogPostController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\BlogPostController@index',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'blogPost.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/blogPost/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'blogPost.create',
        'uses' => 'App\\Http\\Controllers\\Admin\\BlogPostController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\BlogPostController@create',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'blogPost.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'superadmin/blogPost',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'blogPost.store',
        'uses' => 'App\\Http\\Controllers\\Admin\\BlogPostController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\BlogPostController@store',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'blogPost.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/blogPost/{blogPost}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'blogPost.show',
        'uses' => 'App\\Http\\Controllers\\Admin\\BlogPostController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\BlogPostController@show',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'blogPost.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/blogPost/{blogPost}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'blogPost.edit',
        'uses' => 'App\\Http\\Controllers\\Admin\\BlogPostController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\BlogPostController@edit',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'blogPost.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'superadmin/blogPost/{blogPost}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'blogPost.update',
        'uses' => 'App\\Http\\Controllers\\Admin\\BlogPostController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\BlogPostController@update',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'blogPost.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'superadmin/blogPost/{blogPost}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'blogPost.destroy',
        'uses' => 'App\\Http\\Controllers\\Admin\\BlogPostController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\BlogPostController@destroy',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'blogPost.checkSlug2' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/checkSlug2',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\BlogPostController@checkSlug2',
        'controller' => 'App\\Http\\Controllers\\Admin\\BlogPostController@checkSlug2',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
        'as' => 'blogPost.checkSlug2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'category.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/category',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'category.index',
        'uses' => 'App\\Http\\Controllers\\Admin\\CategoryController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\CategoryController@index',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'category.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/category/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'category.create',
        'uses' => 'App\\Http\\Controllers\\Admin\\CategoryController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\CategoryController@create',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'category.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'superadmin/category',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'category.store',
        'uses' => 'App\\Http\\Controllers\\Admin\\CategoryController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\CategoryController@store',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'category.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/category/{category}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'category.show',
        'uses' => 'App\\Http\\Controllers\\Admin\\CategoryController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\CategoryController@show',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'category.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/category/{category}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'category.edit',
        'uses' => 'App\\Http\\Controllers\\Admin\\CategoryController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\CategoryController@edit',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'category.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'superadmin/category/{category}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'category.update',
        'uses' => 'App\\Http\\Controllers\\Admin\\CategoryController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\CategoryController@update',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'category.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'superadmin/category/{category}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'category.destroy',
        'uses' => 'App\\Http\\Controllers\\Admin\\CategoryController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\CategoryController@destroy',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'category.checkSlug3' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/checkSlug3',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CategoryController@checkSlug3',
        'controller' => 'App\\Http\\Controllers\\Admin\\CategoryController@checkSlug3',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
        'as' => 'category.checkSlug3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'course.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/course',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'course.index',
        'uses' => 'App\\Http\\Controllers\\Admin\\CourseController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\CourseController@index',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'course.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/course/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'course.create',
        'uses' => 'App\\Http\\Controllers\\Admin\\CourseController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\CourseController@create',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'course.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'superadmin/course',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'course.store',
        'uses' => 'App\\Http\\Controllers\\Admin\\CourseController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\CourseController@store',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'course.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/course/{course}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'course.show',
        'uses' => 'App\\Http\\Controllers\\Admin\\CourseController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\CourseController@show',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'course.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/course/{course}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'course.edit',
        'uses' => 'App\\Http\\Controllers\\Admin\\CourseController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\CourseController@edit',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'course.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'superadmin/course/{course}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'course.update',
        'uses' => 'App\\Http\\Controllers\\Admin\\CourseController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\CourseController@update',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'course.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'superadmin/course/{course}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'course.destroy',
        'uses' => 'App\\Http\\Controllers\\Admin\\CourseController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\CourseController@destroy',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'course.checkSlug4' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/checkSlug4',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CourseController@checkSlug4',
        'controller' => 'App\\Http\\Controllers\\Admin\\CourseController@checkSlug4',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
        'as' => 'course.checkSlug4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'courseCalendar.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/courseCalendar',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'courseCalendar.index',
        'uses' => 'App\\Http\\Controllers\\Admin\\CourseCalendarController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\CourseCalendarController@index',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'courseCalendar.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/courseCalendar/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'courseCalendar.create',
        'uses' => 'App\\Http\\Controllers\\Admin\\CourseCalendarController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\CourseCalendarController@create',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'courseCalendar.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'superadmin/courseCalendar',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'courseCalendar.store',
        'uses' => 'App\\Http\\Controllers\\Admin\\CourseCalendarController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\CourseCalendarController@store',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'courseCalendar.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/courseCalendar/{courseCalendar}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'courseCalendar.show',
        'uses' => 'App\\Http\\Controllers\\Admin\\CourseCalendarController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\CourseCalendarController@show',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'courseCalendar.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/courseCalendar/{courseCalendar}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'courseCalendar.edit',
        'uses' => 'App\\Http\\Controllers\\Admin\\CourseCalendarController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\CourseCalendarController@edit',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'courseCalendar.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'superadmin/courseCalendar/{courseCalendar}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'courseCalendar.update',
        'uses' => 'App\\Http\\Controllers\\Admin\\CourseCalendarController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\CourseCalendarController@update',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'courseCalendar.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'superadmin/courseCalendar/{courseCalendar}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'courseCalendar.destroy',
        'uses' => 'App\\Http\\Controllers\\Admin\\CourseCalendarController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\CourseCalendarController@destroy',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'image.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/image',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'image.index',
        'uses' => 'App\\Http\\Controllers\\Admin\\ImageController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\ImageController@index',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'image.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/image/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'image.create',
        'uses' => 'App\\Http\\Controllers\\Admin\\ImageController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\ImageController@create',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'image.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'superadmin/image',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'image.store',
        'uses' => 'App\\Http\\Controllers\\Admin\\ImageController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\ImageController@store',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'image.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/image/{image}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'image.show',
        'uses' => 'App\\Http\\Controllers\\Admin\\ImageController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\ImageController@show',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'image.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/image/{image}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'image.edit',
        'uses' => 'App\\Http\\Controllers\\Admin\\ImageController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\ImageController@edit',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'image.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'superadmin/image/{image}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'image.update',
        'uses' => 'App\\Http\\Controllers\\Admin\\ImageController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\ImageController@update',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'image.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'superadmin/image/{image}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'image.destroy',
        'uses' => 'App\\Http\\Controllers\\Admin\\ImageController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\ImageController@destroy',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apBlogCategory.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/apBlogCategory',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'apBlogCategory.index',
        'uses' => 'App\\Http\\Controllers\\Admin\\ApBlogCategoryController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApBlogCategoryController@index',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apBlogCategory.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/apBlogCategory/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'apBlogCategory.create',
        'uses' => 'App\\Http\\Controllers\\Admin\\ApBlogCategoryController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApBlogCategoryController@create',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apBlogCategory.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'superadmin/apBlogCategory',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'apBlogCategory.store',
        'uses' => 'App\\Http\\Controllers\\Admin\\ApBlogCategoryController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApBlogCategoryController@store',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apBlogCategory.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/apBlogCategory/{apBlogCategory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'apBlogCategory.show',
        'uses' => 'App\\Http\\Controllers\\Admin\\ApBlogCategoryController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApBlogCategoryController@show',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apBlogCategory.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/apBlogCategory/{apBlogCategory}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'apBlogCategory.edit',
        'uses' => 'App\\Http\\Controllers\\Admin\\ApBlogCategoryController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApBlogCategoryController@edit',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apBlogCategory.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'superadmin/apBlogCategory/{apBlogCategory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'apBlogCategory.update',
        'uses' => 'App\\Http\\Controllers\\Admin\\ApBlogCategoryController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApBlogCategoryController@update',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apBlogCategory.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'superadmin/apBlogCategory/{apBlogCategory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'apBlogCategory.destroy',
        'uses' => 'App\\Http\\Controllers\\Admin\\ApBlogCategoryController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApBlogCategoryController@destroy',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apBlogCategory.checkSlug5' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/checkSlug5',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ApBlogCategoryController@checkSlug5',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApBlogCategoryController@checkSlug5',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
        'as' => 'apBlogCategory.checkSlug5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apBlogPost.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/apBlogPost',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'apBlogPost.index',
        'uses' => 'App\\Http\\Controllers\\Admin\\ApBlogPostController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApBlogPostController@index',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apBlogPost.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/apBlogPost/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'apBlogPost.create',
        'uses' => 'App\\Http\\Controllers\\Admin\\ApBlogPostController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApBlogPostController@create',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apBlogPost.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'superadmin/apBlogPost',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'apBlogPost.store',
        'uses' => 'App\\Http\\Controllers\\Admin\\ApBlogPostController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApBlogPostController@store',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apBlogPost.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/apBlogPost/{apBlogPost}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'apBlogPost.show',
        'uses' => 'App\\Http\\Controllers\\Admin\\ApBlogPostController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApBlogPostController@show',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apBlogPost.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/apBlogPost/{apBlogPost}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'apBlogPost.edit',
        'uses' => 'App\\Http\\Controllers\\Admin\\ApBlogPostController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApBlogPostController@edit',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apBlogPost.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'superadmin/apBlogPost/{apBlogPost}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'apBlogPost.update',
        'uses' => 'App\\Http\\Controllers\\Admin\\ApBlogPostController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApBlogPostController@update',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apBlogPost.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'superadmin/apBlogPost/{apBlogPost}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'apBlogPost.destroy',
        'uses' => 'App\\Http\\Controllers\\Admin\\ApBlogPostController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApBlogPostController@destroy',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apBlogPost.checkSlug6' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/checkSlug6',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ApBlogPostController@checkSlug6',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApBlogPostController@checkSlug6',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
        'as' => 'apBlogPost.checkSlug6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apCategory.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/apCategory',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'apCategory.index',
        'uses' => 'App\\Http\\Controllers\\Admin\\ApCategoryController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApCategoryController@index',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apCategory.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/apCategory/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'apCategory.create',
        'uses' => 'App\\Http\\Controllers\\Admin\\ApCategoryController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApCategoryController@create',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apCategory.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'superadmin/apCategory',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'apCategory.store',
        'uses' => 'App\\Http\\Controllers\\Admin\\ApCategoryController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApCategoryController@store',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apCategory.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/apCategory/{apCategory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'apCategory.show',
        'uses' => 'App\\Http\\Controllers\\Admin\\ApCategoryController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApCategoryController@show',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apCategory.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/apCategory/{apCategory}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'apCategory.edit',
        'uses' => 'App\\Http\\Controllers\\Admin\\ApCategoryController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApCategoryController@edit',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apCategory.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'superadmin/apCategory/{apCategory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'apCategory.update',
        'uses' => 'App\\Http\\Controllers\\Admin\\ApCategoryController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApCategoryController@update',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apCategory.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'superadmin/apCategory/{apCategory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'apCategory.destroy',
        'uses' => 'App\\Http\\Controllers\\Admin\\ApCategoryController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApCategoryController@destroy',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apCategory.checkSlug7' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/checkSlug7',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ApCategoryController@checkSlug7',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApCategoryController@checkSlug7',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
        'as' => 'apCategory.checkSlug7',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apCourse.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/apCourse',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'apCourse.index',
        'uses' => 'App\\Http\\Controllers\\Admin\\ApCourseController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApCourseController@index',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apCourse.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/apCourse/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'apCourse.create',
        'uses' => 'App\\Http\\Controllers\\Admin\\ApCourseController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApCourseController@create',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apCourse.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'superadmin/apCourse',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'apCourse.store',
        'uses' => 'App\\Http\\Controllers\\Admin\\ApCourseController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApCourseController@store',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apCourse.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/apCourse/{apCourse}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'apCourse.show',
        'uses' => 'App\\Http\\Controllers\\Admin\\ApCourseController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApCourseController@show',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apCourse.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/apCourse/{apCourse}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'apCourse.edit',
        'uses' => 'App\\Http\\Controllers\\Admin\\ApCourseController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApCourseController@edit',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apCourse.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'superadmin/apCourse/{apCourse}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'apCourse.update',
        'uses' => 'App\\Http\\Controllers\\Admin\\ApCourseController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApCourseController@update',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apCourse.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'superadmin/apCourse/{apCourse}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'as' => 'apCourse.destroy',
        'uses' => 'App\\Http\\Controllers\\Admin\\ApCourseController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApCourseController@destroy',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'apCourse.checkSlug8' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'superadmin/checkSlug8',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'adminauth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ApCourseController@checkSlug8',
        'controller' => 'App\\Http\\Controllers\\Admin\\ApCourseController@checkSlug8',
        'namespace' => NULL,
        'prefix' => '/superadmin',
        'where' => 
        array (
        ),
        'as' => 'apCourse.checkSlug8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'course',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Site\\HomeController@index',
        'controller' => 'App\\Http\\Controllers\\Site\\HomeController@index',
        'namespace' => NULL,
        'prefix' => '/course',
        'where' => 
        array (
        ),
        'as' => 'home.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'locale.set' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'course/switchlocale/{locale}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Site\\HomeController@switchlocale',
        'controller' => 'App\\Http\\Controllers\\Site\\HomeController@switchlocale',
        'namespace' => NULL,
        'prefix' => '/course',
        'where' => 
        array (
        ),
        'as' => 'locale.set',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home.calendar' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'course/calendar/{month?}/{year?}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Site\\HomeController@calendar',
        'controller' => 'App\\Http\\Controllers\\Site\\HomeController@calendar',
        'namespace' => NULL,
        'prefix' => '/course',
        'where' => 
        array (
        ),
        'as' => 'home.calendar',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home.blogs' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'course/blogs',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Site\\HomeController@blogs',
        'controller' => 'App\\Http\\Controllers\\Site\\HomeController@blogs',
        'namespace' => NULL,
        'prefix' => '/course',
        'where' => 
        array (
        ),
        'as' => 'home.blogs',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home.blog' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'course/blog/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Site\\HomeController@blog',
        'controller' => 'App\\Http\\Controllers\\Site\\HomeController@blog',
        'namespace' => NULL,
        'prefix' => '/course',
        'where' => 
        array (
        ),
        'as' => 'home.blog',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home.courses' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'course/courses/{slug?}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Site\\HomeController@courses',
        'controller' => 'App\\Http\\Controllers\\Site\\HomeController@courses',
        'namespace' => NULL,
        'prefix' => '/course',
        'where' => 
        array (
        ),
        'as' => 'home.courses',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home.course' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'course/course/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Site\\HomeController@course',
        'controller' => 'App\\Http\\Controllers\\Site\\HomeController@course',
        'namespace' => NULL,
        'prefix' => '/course',
        'where' => 
        array (
        ),
        'as' => 'home.course',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home.registerMail' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'course/register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Site\\HomeController@registerMail',
        'controller' => 'App\\Http\\Controllers\\Site\\HomeController@registerMail',
        'namespace' => NULL,
        'prefix' => '/course',
        'where' => 
        array (
        ),
        'as' => 'home.registerMail',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home.contact' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'course/contact',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Site\\HomeController@contact',
        'controller' => 'App\\Http\\Controllers\\Site\\HomeController@contact',
        'namespace' => NULL,
        'prefix' => '/course',
        'where' => 
        array (
        ),
        'as' => 'home.contact',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home.contactMail' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'course/contact',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Site\\HomeController@contactMail',
        'controller' => 'App\\Http\\Controllers\\Site\\HomeController@contactMail',
        'namespace' => NULL,
        'prefix' => '/course',
        'where' => 
        array (
        ),
        'as' => 'home.contactMail',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home.findCourse' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'course/findCourse',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Site\\HomeController@findCourse',
        'controller' => 'App\\Http\\Controllers\\Site\\HomeController@findCourse',
        'namespace' => NULL,
        'prefix' => '/course',
        'where' => 
        array (
        ),
        'as' => 'home.findCourse',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home.gallery' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'course/gallery',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Site\\HomeController@gallery',
        'controller' => 'App\\Http\\Controllers\\Site\\HomeController@gallery',
        'namespace' => NULL,
        'prefix' => '/course',
        'where' => 
        array (
        ),
        'as' => 'home.gallery',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home.paynow' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'course/paynow',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Site\\HomeController@paynow',
        'controller' => 'App\\Http\\Controllers\\Site\\HomeController@paynow',
        'namespace' => NULL,
        'prefix' => '/course',
        'where' => 
        array (
        ),
        'as' => 'home.paynow',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home.terms' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'course/terms',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Site\\HomeController@terms',
        'controller' => 'App\\Http\\Controllers\\Site\\HomeController@terms',
        'namespace' => NULL,
        'prefix' => '/course',
        'where' => 
        array (
        ),
        'as' => 'home.terms',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home.privacy' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'course/privacy',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Site\\HomeController@privacy',
        'controller' => 'App\\Http\\Controllers\\Site\\HomeController@privacy',
        'namespace' => NULL,
        'prefix' => '/course',
        'where' => 
        array (
        ),
        'as' => 'home.privacy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home.shipping' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'course/shipping',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Site\\HomeController@shipping',
        'controller' => 'App\\Http\\Controllers\\Site\\HomeController@shipping',
        'namespace' => NULL,
        'prefix' => '/course',
        'where' => 
        array (
        ),
        'as' => 'home.shipping',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home.refund' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'course/refund',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Site\\HomeController@refund',
        'controller' => 'App\\Http\\Controllers\\Site\\HomeController@refund',
        'namespace' => NULL,
        'prefix' => '/course',
        'where' => 
        array (
        ),
        'as' => 'home.refund',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home.about' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'course/about',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Site\\HomeController@about',
        'controller' => 'App\\Http\\Controllers\\Site\\HomeController@about',
        'namespace' => NULL,
        'prefix' => '/course',
        'where' => 
        array (
        ),
        'as' => 'home.about',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home.career' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'course/career',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Site\\HomeController@career',
        'controller' => 'App\\Http\\Controllers\\Site\\HomeController@career',
        'namespace' => NULL,
        'prefix' => '/course',
        'where' => 
        array (
        ),
        'as' => 'home.career',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home.paynowPost' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'paynow',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\MainController@paynowPost',
        'controller' => 'App\\Http\\Controllers\\MainController@paynowPost',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'home.paynowPost',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home.response' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'response',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\MainController@response',
        'controller' => 'App\\Http\\Controllers\\MainController@response',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'home.response',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'main.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\MainController@index',
        'controller' => 'App\\Http\\Controllers\\MainController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'main.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisalController@index',
        'controller' => 'App\\Http\\Controllers\\AppraisalController@index',
        'namespace' => NULL,
        'prefix' => '/appraisal',
        'where' => 
        array (
        ),
        'as' => 'appraisal.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.faq' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/faq',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisalController@faq',
        'controller' => 'App\\Http\\Controllers\\AppraisalController@faq',
        'namespace' => NULL,
        'prefix' => '/appraisal',
        'where' => 
        array (
        ),
        'as' => 'appraisal.faq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.terms' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/terms',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisalController@terms',
        'controller' => 'App\\Http\\Controllers\\AppraisalController@terms',
        'namespace' => NULL,
        'prefix' => '/appraisal',
        'where' => 
        array (
        ),
        'as' => 'appraisal.terms',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.paynow' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/paynow',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisalController@paynow',
        'controller' => 'App\\Http\\Controllers\\AppraisalController@paynow',
        'namespace' => NULL,
        'prefix' => '/appraisal',
        'where' => 
        array (
        ),
        'as' => 'appraisal.paynow',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.contact' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/contact',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisalController@contact',
        'controller' => 'App\\Http\\Controllers\\AppraisalController@contact',
        'namespace' => NULL,
        'prefix' => '/appraisal',
        'where' => 
        array (
        ),
        'as' => 'appraisal.contact',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.contactMail' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'appraisal/contact',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisalController@contactMail',
        'controller' => 'App\\Http\\Controllers\\AppraisalController@contactMail',
        'namespace' => NULL,
        'prefix' => '/appraisal',
        'where' => 
        array (
        ),
        'as' => 'appraisal.contactMail',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.blogs' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/blogs',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisalController@blogs',
        'controller' => 'App\\Http\\Controllers\\AppraisalController@blogs',
        'namespace' => NULL,
        'prefix' => '/appraisal',
        'where' => 
        array (
        ),
        'as' => 'appraisal.blogs',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.blog' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/blog/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisalController@blog',
        'controller' => 'App\\Http\\Controllers\\AppraisalController@blog',
        'namespace' => NULL,
        'prefix' => '/appraisal',
        'where' => 
        array (
        ),
        'as' => 'appraisal.blog',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.courses' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/services/{slug?}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisalController@courses',
        'controller' => 'App\\Http\\Controllers\\AppraisalController@courses',
        'namespace' => NULL,
        'prefix' => '/appraisal',
        'where' => 
        array (
        ),
        'as' => 'appraisal.courses',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.course' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/service/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisalController@course',
        'controller' => 'App\\Http\\Controllers\\AppraisalController@course',
        'namespace' => NULL,
        'prefix' => '/appraisal',
        'where' => 
        array (
        ),
        'as' => 'appraisal.course',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.register.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'appraisal/register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@registerSubmit',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@registerSubmit',
        'namespace' => NULL,
        'prefix' => '/appraisal',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.register.submit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.privacy' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/privacy',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisalController@privacy',
        'controller' => 'App\\Http\\Controllers\\AppraisalController@privacy',
        'namespace' => NULL,
        'prefix' => '/appraisal',
        'where' => 
        array (
        ),
        'as' => 'appraisal.privacy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.shipping' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/shipping',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisalController@shipping',
        'controller' => 'App\\Http\\Controllers\\AppraisalController@shipping',
        'namespace' => NULL,
        'prefix' => '/appraisal',
        'where' => 
        array (
        ),
        'as' => 'appraisal.shipping',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.refund' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/refund',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisalController@refund',
        'controller' => 'App\\Http\\Controllers\\AppraisalController@refund',
        'namespace' => NULL,
        'prefix' => '/appraisal',
        'where' => 
        array (
        ),
        'as' => 'appraisal.refund',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.about' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/about',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisalController@about',
        'controller' => 'App\\Http\\Controllers\\AppraisalController@about',
        'namespace' => NULL,
        'prefix' => '/appraisal',
        'where' => 
        array (
        ),
        'as' => 'appraisal.about',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.career' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/career',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisalController@career',
        'controller' => 'App\\Http\\Controllers\\AppraisalController@career',
        'namespace' => NULL,
        'prefix' => '/appraisal',
        'where' => 
        array (
        ),
        'as' => 'appraisal.career',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.register' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@register',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@register',
        'namespace' => NULL,
        'prefix' => '/appraisal',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.register',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.resendOtp' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'appraisal/resend-otp',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@resendOtp',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@resendOtp',
        'namespace' => NULL,
        'prefix' => '/appraisal',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.resendOtp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.emailConfirmation' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/email-confirmation',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@emailConfirmation',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@emailConfirmation',
        'namespace' => NULL,
        'prefix' => '/appraisal',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.emailConfirmation',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.emailConfirmationSubmit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'appraisal/email-confirmation-submit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@emailConfirmationSubmit',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@emailConfirmationSubmit',
        'namespace' => NULL,
        'prefix' => '/appraisal',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.emailConfirmationSubmit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.passwordReset' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/password-reset',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@passwordReset',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@passwordReset',
        'namespace' => NULL,
        'prefix' => '/appraisal',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.passwordReset',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@login',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@login',
        'namespace' => NULL,
        'prefix' => '/appraisal',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.login',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.loginSubmit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'appraisal/login-submit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@loginSubmit',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@loginSubmit',
        'namespace' => NULL,
        'prefix' => '/appraisal',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.loginSubmit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@index',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@index',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.instructions' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/user/instructions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@instructions',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@instructions',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.instructions',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.personal-details' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/user/personal-details',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@personalDetails',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@personalDetails',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.personal-details',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.personal-details.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'appraisal/user/personal-details-submit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@personalDetailsSubmit',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@personalDetailsSubmit',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.personal-details.submit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.scope-of-work' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/user/scope-of-work',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@scopeOfWork',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@scopeOfWork',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.scope-of-work',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.scope-of-work.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'appraisal/user/scope-of-work-submit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@scopeOfWorkSubmit',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@scopeOfWorkSubmit',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.scope-of-work.submit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.annual-appraisals' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/user/annual-appraisals',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@annualAppraisals',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@annualAppraisals',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.annual-appraisals',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.annual-appraisals.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'appraisal/user/annual-appraisals-submit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@annualAppraisalsSubmit',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@annualAppraisalsSubmit',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.annual-appraisals.submit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.development-plans' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/user/development-plans',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@developmentPlans',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@developmentPlans',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.development-plans',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.development-plans.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'appraisal/user/development-plans-submit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@developmentPlansSubmit',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@developmentPlansSubmit',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.development-plans.submit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.cpd' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/user/cpd',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@cpd',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@cpd',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.cpd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.cpd.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'appraisal/user/cpd-submit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@cpdSubmit',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@cpdSubmit',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.cpd.submit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.quality-improvement' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/user/quality-improvement',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@qualityImprovement',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@qualityImprovement',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.quality-improvement',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.quality-improvement.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'appraisal/user/quality-improvement-submit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@qualityImprovementSubmit',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@qualityImprovementSubmit',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.quality-improvement.submit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.significant-events' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/user/significant-events',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@significantEvents',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@significantEvents',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.significant-events',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.significant-events.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'appraisal/user/significant-events-submit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@significantEventsSubmit',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@significantEventsSubmit',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.significant-events.submit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.feedback' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/user/feedback',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@feedback',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@feedback',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.feedback',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.feedback.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'appraisal/user/feedback-submit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@feedbackSubmit',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@feedbackSubmit',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.feedback.submit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.complaints' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/user/complaints',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@complaints',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@complaints',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.complaints',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.complaints.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'appraisal/user/complaints-submit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@complaintsSubmit',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@complaintsSubmit',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.complaints.submit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.achievements' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/user/achievements',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@achievements',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@achievements',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.achievements',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.achievements.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'appraisal/user/achievements-submit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@achievementsSubmit',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@achievementsSubmit',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.achievements.submit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.probity' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/user/probity',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@probity',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@probity',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.probity',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.probity.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'appraisal/user/probity-submit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@probitySubmit',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@probitySubmit',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.probity.submit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.additional-info' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/user/additional-info',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@additionalInfo',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@additionalInfo',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.additional-info',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.additional-info.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'appraisal/user/additional-info-submit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@additionalInfoSubmit',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@additionalInfoSubmit',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.additional-info.submit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.supporting-info' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/user/supporting-info',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@supportingInfo',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@supportingInfo',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.supporting-info',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.gmc-domains' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/user/gmc-domains',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@gmcDomains',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@gmcDomains',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.gmc-domains',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.gmc-domains.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'appraisal/user/gmc-domains-submit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@gmcDomainsSubmit',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@gmcDomainsSubmit',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.gmc-domains.submit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.checklist' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/user/checklist',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@checklist',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@checklist',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.checklist',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.checklist.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'appraisal/user/checklist-submit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@checklistSubmit',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@checklistSubmit',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.checklist.submit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.development-plan' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/user/personal-development-plan',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@personalDevelopmentPlan',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@personalDevelopmentPlan',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.development-plan',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.development-plan.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'appraisal/user/personal-development-plan-submit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@personalDevelopmentPlanSubmit',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@personalDevelopmentPlanSubmit',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.development-plan.submit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.summary' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/user/summary',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@summary',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@summary',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.summary',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.summary.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'appraisal/user/summary-submit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@summarySubmit',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@summarySubmit',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.summary.submit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.outputs' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/user/outputs',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@outputs',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@outputs',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.outputs',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.outputs.submit' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'appraisal/user/outputs-submit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@outputsSubmit',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@outputsSubmit',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.outputs.submit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.completion' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/user/completion',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@completion',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@completion',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.completion',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.file.download' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/user/file-download/{fileName}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@fileDownload',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@fileDownload',
        'namespace' => NULL,
        'prefix' => 'appraisal/user',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.file.download',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.completion.pdf' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/pdf}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@generatePDF',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@generatePDF',
        'namespace' => NULL,
        'prefix' => '/appraisal',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.completion.pdf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'appraisal.user.completion.download.pdf' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'appraisal/pdf-download/{filename}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\AppraisaUserController@downloadPdf',
        'controller' => 'App\\Http\\Controllers\\AppraisaUserController@downloadPdf',
        'namespace' => NULL,
        'prefix' => '/appraisal',
        'where' => 
        array (
        ),
        'as' => 'appraisal.user.completion.download.pdf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'product.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'product',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProductController@index',
        'controller' => 'App\\Http\\Controllers\\ProductController@index',
        'namespace' => NULL,
        'prefix' => '/product',
        'where' => 
        array (
        ),
        'as' => 'product.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'product.jtip' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'product/j-tip',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProductController@jtip',
        'controller' => 'App\\Http\\Controllers\\ProductController@jtip',
        'namespace' => NULL,
        'prefix' => '/product',
        'where' => 
        array (
        ),
        'as' => 'product.jtip',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'product.victor' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'product/victor',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProductController@victor',
        'controller' => 'App\\Http\\Controllers\\ProductController@victor',
        'namespace' => NULL,
        'prefix' => '/product',
        'where' => 
        array (
        ),
        'as' => 'product.victor',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'product.terms' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'product/terms',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProductController@terms',
        'controller' => 'App\\Http\\Controllers\\ProductController@terms',
        'namespace' => NULL,
        'prefix' => '/product',
        'where' => 
        array (
        ),
        'as' => 'product.terms',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'product.paynow' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'product/paynow',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProductController@paynow',
        'controller' => 'App\\Http\\Controllers\\ProductController@paynow',
        'namespace' => NULL,
        'prefix' => '/product',
        'where' => 
        array (
        ),
        'as' => 'product.paynow',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'product.contact' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'product/contact',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProductController@contact',
        'controller' => 'App\\Http\\Controllers\\ProductController@contact',
        'namespace' => NULL,
        'prefix' => '/product',
        'where' => 
        array (
        ),
        'as' => 'product.contact',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'product.contactMail' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'product/contact',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProductController@contactMail',
        'controller' => 'App\\Http\\Controllers\\ProductController@contactMail',
        'namespace' => NULL,
        'prefix' => '/product',
        'where' => 
        array (
        ),
        'as' => 'product.contactMail',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'product.privacy' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'product/privacy',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProductController@privacy',
        'controller' => 'App\\Http\\Controllers\\ProductController@privacy',
        'namespace' => NULL,
        'prefix' => '/product',
        'where' => 
        array (
        ),
        'as' => 'product.privacy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'product.shipping' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'product/shipping',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProductController@shipping',
        'controller' => 'App\\Http\\Controllers\\ProductController@shipping',
        'namespace' => NULL,
        'prefix' => '/product',
        'where' => 
        array (
        ),
        'as' => 'product.shipping',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'product.refund' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'product/refund',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProductController@refund',
        'controller' => 'App\\Http\\Controllers\\ProductController@refund',
        'namespace' => NULL,
        'prefix' => '/product',
        'where' => 
        array (
        ),
        'as' => 'product.refund',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'product.about' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'product/about',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProductController@about',
        'controller' => 'App\\Http\\Controllers\\ProductController@about',
        'namespace' => NULL,
        'prefix' => '/product',
        'where' => 
        array (
        ),
        'as' => 'product.about',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'product.career' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'product/career',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProductController@career',
        'controller' => 'App\\Http\\Controllers\\ProductController@career',
        'namespace' => NULL,
        'prefix' => '/product',
        'where' => 
        array (
        ),
        'as' => 'product.career',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::u1Bp8GOGw3CwN9pT' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'logs',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'Rap2hpoutre\\LaravelLogViewer\\LogViewerController@index',
        'controller' => 'Rap2hpoutre\\LaravelLogViewer\\LogViewerController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::u1Bp8GOGw3CwN9pT',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::aJwnsU4aHa33BM0P' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'O:47:"Laravel\\SerializableClosure\\SerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Signed":2:{s:12:"serializable";s:295:"O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:77:"function (\\Illuminate\\Http\\Request $request) {
    return $request->user();
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000a030000000000000000";}";s:4:"hash";s:44:"tXyH4V/gv3IBjZFPgdYDPmcWeQ8If9GYQgfJjqaPG7w=";}}',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::aJwnsU4aHa33BM0P',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
