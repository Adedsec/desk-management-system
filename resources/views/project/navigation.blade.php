<ul class="nav nav-tabs shadow text-light" style="margin-left: -12px;margin-right: -12px">
    <li class="nav-item">
        <a class="nav-link {{ \Illuminate\Support\Facades\Route::currentRouteName() === 'projects.show' ? 'active' : ''}} text-danger   "
           aria-current="page" href="{{route('projects.show',$project->id)}}">وظایف پروژه</a>
    </li>
    <li class="nav-item ">
        <a class="nav-link  {{ \Illuminate\Support\Facades\Route::currentRouteName() === 'project.board' ? 'active' : ''}}  text-danger"
           href="{{route('project.board',$project->id)}}">بورد پروژه</a>
    </li>

    <livewire:components.task-tags-menu/>

</ul>
