<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link active">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>


@if (Auth::user()->isSuperAdmin()) {
<li class="nav-item">
    <a href="{{ route('user.index') }}" class="nav-link">
        <i class="nav-icon fas fa-user-plus"></i>
        <p>
            會員列表
        </p>
    </a>
</li>
@endif

@if(Auth::user()->isSuperAdmin())
<li class="nav-item">
    <a href="{{ route('userGroup.index') }}" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
            會員權限設定
        </p>
    </a>
</li>
@endif

@if(Auth::user()->has(['bugTask','featureTask','testTask'],'read'))
<li class="nav-item">
    <a href="{{ route('task.index') }}" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
            任務列表
        </p>
    </a>
</li>
@endif