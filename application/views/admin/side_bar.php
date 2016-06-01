<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
            <li class="sub-menu <?=($active=="home")? 'active' : ''?>">
                <a class="" href="/user/home">
                    <i class="icon_house_alt"></i>
                    <span>Главная</span>
                </a>
            </li>
                <li class="sub-menu <?=($active=="ulist")? 'active' : ''?>">
                    <a href="/user/ulist" class="">
                        <i class="icon_group"></i>
                        <span>Служби</span>
                    </a>
                </li>
            <li class="sub-menu <?=($active=="clist")? 'active' : ''?>">
                <a href="/user/clist" class="">
                    <i class="icon_id-2"></i>
                    <span>Фільтри</span>
                </a>
            </li>
            <li class="sub-menu <?=($active=="path")? 'active' : ''?>">
                <a href="/user/paths" class="">
                    <i class="icon_id-2"></i>
                    <span>Категорії фільтрів</span>
                </a>
            </li>
            <li class="sub-menu <?=($active=="courlist")? 'active' : ''?>">
                <a href="/user/courlist" class="">
                    <i class="glyphicon glyphicon-user"></i>
                    <span>Налаштування</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="/user/logout" class="">
                    <i class="icon_lock_alt"></i>
                    <span>Вихід</span>
                </a>
            </li>

        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>