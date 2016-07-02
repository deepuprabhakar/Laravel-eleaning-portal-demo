<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset('dist/img/default-160x160.jpg') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ Sentinel::getUser()->first_name }}</p>
        <a href="" onclick="return false"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <!-- <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat" style="min-width: auto;"><i class="fa fa-search"></i></button>
        </span>
      </div>
    </form> -->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li class="{{ Request::is('/') ? 'active' : '' }}{{ Request::is('dashboard') ? 'active' : '' }}">
        <a href="{{ url('/') }}">
          <i class="fa fa-home"></i> 
          <span>Home</span>
        </a>
      </li>
      <li class="treeview {{ Request::is('admin/courses') ? 'active' : '' }}{{ Request::is('admin/courses/*') ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-graduation-cap" aria-hidden="true"></i>
          <span>Courses</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::is('admin/courses/create') ? 'active' : '' }}">
            <a href="{{ route('admin.courses.create') }}"><i class="fa fa-circle-o"></i> Create Course</a>
          </li>
          <li class="{{ Request::is('admin/courses') ? 'active' : '' }}">
            <a href="{{ route('admin.courses.index') }}"><i class="fa fa-circle-o"></i> View Courses</a>
          </li>
        </ul>
      </li>
      <li class="treeview {{ Request::is('admin/subjects') ? 'active' : '' }}{{ Request::is('admin/subjects/*') ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-book" aria-hidden="true"></i>
          <span>Subjects</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::is('admin/subjects/create') ? 'active' : '' }}">
            <a href="{{ route('admin.subjects.create') }}"><i class="fa fa-circle-o"></i> Create Subject</a>
          </li>
          <li class="{{ Request::is('admin/subjects') ? 'active' : '' }}">
            <a href="{{ route('admin.subjects.index') }}"><i class="fa fa-circle-o"></i> View Subjects</a>
          </li>
        </ul>
      </li>
      <li class="treeview {{ Request::is('admin/teachers') ? 'active' : '' }}{{ Request::is('admin/teachers/*') ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-female" aria-hidden="true"></i>
          <span>Teachers</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::is('admin/teachers/create') ? 'active' : '' }}">
            <a href="{{ route('admin.teachers.create') }}"><i class="fa fa-circle-o"></i> Add Teacher</a>
          </li>
          <li class="{{ Request::is('admin/teachers') ? 'active' : '' }}">
            <a href="{{ route('admin.teachers.index') }}"><i class="fa fa-circle-o"></i> View Teachers</a>
          </li>
        </ul>
      </li>
      <li class="treeview {{ Request::is('admin/students') ? 'active' : '' }}{{ Request::is('admin/students/*') ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-users" aria-hidden="true"></i>
          <span>Students</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::is('admin/students/create') ? 'active' : '' }}">
            <a href="{{ route('admin.students.create') }}"><i class="fa fa-circle-o"></i> Add Student</a>
          </li>
          <li class="{{ Request::is('admin/students') ? 'active' : '' }}">
            <a href="{{ route('admin.students.index') }}"><i class="fa fa-circle-o"></i> View Students</a>
          </li>
        </ul>
      </li>
      <li class="treeview {{ Request::is('admin/news') ? 'active' : '' }}{{ Request::is('admin/news/*') ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-newspaper-o" aria-hidden="true"></i>
          <span>News</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::is('admin/news/create') ? 'active' : '' }}">
            <a href="{{ route('admin.news.create') }}"><i class="fa fa-circle-o"></i> Create News</a>
          </li>
          <li class="{{ Request::is('admin/news') ? 'active' : '' }}">
            <a href="{{ route('admin.news.index') }}"><i class="fa fa-circle-o"></i> View News</a>
          </li>
        </ul>
      </li>
      <li class="treeview {{ Request::is('admin/test') ? 'active' : '' }}{{ Request::is('admin/test/*') ? 'active' : '' }}">
              <a href="#">
                <i class="fa fa-pencil-square-o"></i> <span>Test</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="treeview {{ Request::is('admin/test/category') ? 'active' : '' }}{{ Request::is('admin/test/category/*') ?'active' : ''}}"><a href="#"><i class="fa fa-circle-o"></i> Category<i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                           <li><a href="{{ route('admin.test.createcategory') }}"><i class="fa fa-circle-o"></i> Create Category</a></li>
                           <li>
                           <a href="{{ route('admin.test.category') }}"><i class="fa fa-circle-o"></i> View Category </a>
                          </li>
                      </ul>
                </li>
                <li class="{{ Request::is('admin/test/question') ? 'active' : '' }}{{ Request::is('admin/test/question/*') ?'active' : ''}}">
                  <a href="#"><i class="fa fa-circle-o"></i> Test Question <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="{{ route('admin.test.createquestion') }}"><i class="fa fa-circle-o"></i> Create Question</a></li>
                    <li>
                      <a href="{{ route('admin.test.question') }}"><i class="fa fa-circle-o"></i> View Question </a>
                    </li>
                  </ul>
                </li>
                <li class="{{ Request::is('admin/test/setquestionpaper') ? 'active' : '' }}{{ Request::is('admin/test/setquestionpaper/*') ?'active' : '' }}"><a href="#"><i class="fa fa-circle-o"></i> Set Question<i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.test.setquestion') }}"><i class="fa fa-circle-o"></i> Set Question</a></li>
                    <li>
                      <a href="{{ route('admin.test.viewsetquestion') }}"><i class="fa fa-circle-o"></i> View Set Question </a>
                    </li>
                  </ul>
                </li>
              </ul>
    </li>
     
      <li class="{{ Request::is('admin/messages') ? 'active' : '' }}{{ Request::is('admin/messages/*') ? 'active' : '' }}">
        <a href="{{ route('admin.messages.index') }}">
          @if($count != 0)
            <i class="fa fa-envelope"></i> 
            <span>Mailbox</span>
            <small class="label pull-right bg-yellow">{{ $count }}</small>
          @else
            <i class="fa fa-envelope"></i> 
            <span>Mailbox</span>
          @endif
        </a>
      </li>
      <li class="treeview {{ Request::is('articles') ? 'active' : '' }}{{ Request::is('articles/*') ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-file-text" aria-hidden="true"></i>
          <span>Articles</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::is('articles/create') ? 'active' : '' }}">
            <a href="{{ route('articles.create') }}"><i class="fa fa-circle-o"></i> Create Article</a>
          </li>
          <li class="{{ Request::is('articles') ? 'active' : '' }}">
            <a href="{{ route('articles.index') }}"><i class="fa fa-circle-o"></i> View Articles</a>
          </li>
          <li class="{{ Request::is('articles/list') ? 'active' : '' }}">
            <a href="{{ route('listArticles') }}"><i class="fa fa-circle-o"></i> Edit Articles</a>
          </li>
        </ul>
      </li>
      <li class="{{ Request::is('admin/projects') ? 'active' : '' }}">
        <a href="{{ route('admin.projects') }}">
          <i class="fa fa-file-text-o" aria-hidden="true"></i>
          <span>Projects</span>
        </a>
      </li>
      <li class="{{ Request::is('admin/gallery') ? 'active' : '' }}">
        <a href="{{ route('admin.gallery') }}">
          <i class="fa fa-file-image-o" aria-hidden="true"></i>
          <span>Gallery</span>
        </a>
      </li>
       <li class="{{ Request::is('admin/progress') ? 'active' : '' }}">
        <a href="{{ route('admin.progress') }}">
          <i class="fa fa-tasks" aria-hidden="true"></i>
          <span>Progress</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>