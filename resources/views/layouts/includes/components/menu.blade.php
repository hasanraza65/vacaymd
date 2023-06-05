<ul class="list-unstyled menu-categories" id="accordionExample">

    <li class="menu {{ request()->is('admin') || request()->is('patient') || request()->is('doctor') || request()->is('pharmacy') ? 'active' : ''}}">
        <a href="/" aria-expanded="false" class="dropdown-toggle">
            <div class="">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                <span>Dashboard</span>
            </div>
        </a>
    </li>

    @if(Auth::user()->user_role == 1)

    <li class="menu {{ request()->is('admin/users*') ? 'active' : '' }}">
        <a href="#users" data-bs-toggle="collapse" aria-expanded="{{ request()->is('admin/users*') ? 'true' : 'false' }}" class="dropdown-toggle">
            <div class="">
                <!-- ... -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>

                <span>Users</span>
            </div>
            <div>
                <!-- ... -->
            </div>
        </a>
        <ul class="collapse submenu list-unstyled {{ request()->is('admin/users*') ? 'show' : '' }}" id="users" data-bs-parent="#accordionExample">
            <li class="{{ request()->is('admin/users') ? 'active' : '' }}">
                <a href="/admin/users"> All Users </a>
            </li>
            <li class="{{ request()->is('admin/users/create') ? 'active' : '' }}">
                <a href="/admin/users/create"> Add User </a>
            </li>
        </ul>
    </li>

    <!--- Orders --->
    <li class="menu {{ request()->is('admin/orders') ? 'active' : '' }}">
        <a href="/admin/orders" aria-expanded="false" class="dropdown-toggle">
            <div class="">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg>
            <span>All Orders</span>
            </div>
        </a>
    </li>
    <!--- Ending Orders --->

    <!--- Admin Patients --->

    <li class="menu {{ request()->is('admin/patients') ? 'active' : '' }}">
        <a href="/admin/patients" aria-expanded="false" class="dropdown-toggle">
            <div class="">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            <span>All Patients</span>
            </div>
        </a>
    </li>
    <!--- Ending Admin Patients --->

    <!--- Admin Doctors --->
    <li class="menu {{ request()->is('admin/doctors*') ? 'active' : '' }}">
        <a href="#admin_doctors" data-bs-toggle="collapse" aria-expanded="{{ request()->is('admin/doctors*') ? 'true' : 'false' }}" class="dropdown-toggle">
            <div class="">
                <!-- ... -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                <span>Doctors</span>
            </div>
            <div>
                <!-- ... -->
            </div>
        </a>
        <ul class="collapse submenu list-unstyled {{ request()->is('admin/doctors*') ? 'show' : '' }}" id="admin_doctors" data-bs-parent="#accordionExample">
            <li class="{{ request()->is('admin/doctors') ? 'active' : '' }}">
                <a href="/admin/doctors"> All Doctors </a>
            </li>
            <li class="{{ request()->is('admin/doctors/create') ? 'active' : '' }}">
                <a href="/admin/doctors/create"> Add Doctor </a>
            </li>
        </ul>
    </li>
    <!--- Ending Admin Doctors --->

    <!--- Admin Pharamacies --->
    <li class="menu {{ request()->is('admin/pharmacies*') ? 'active' : '' }}">
        <a href="/admin/pharmacies" aria-expanded="false" class="dropdown-toggle">
            <div class="">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            <span>Pharmacies</span>
            </div>
        </a>
    </li>
    <!--- Ending Admin Pharamacies --->

    <!--- Admin Prescriptions ---> 

    <li class="menu {{ request()->is('admin/prescriptions*') ? 'active' : '' }}">
        <a href="#admin_prescriptions" data-bs-toggle="collapse" aria-expanded="{{ request()->is('admin/prescriptions*') ? 'true' : 'false' }}" class="dropdown-toggle">
            <div class="">
                <!-- ... -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                <span>Prescriptions</span>
            </div>
            <div>
                <!-- ... -->
            </div>
        </a>
        <ul class="collapse submenu list-unstyled {{ request()->is('admin/prescriptions*') ? 'show' : '' }}" id="admin_prescriptions" data-bs-parent="#accordionExample">
            <li class="{{ request()->is('admin/prescriptions') ? 'active' : '' }}">
                <a href="/admin/prescriptions"> All Prescriptions </a>
            </li>
            <li class="{{ request()->is('admin/prescriptions/create') ? 'active' : '' }}">
                <a href="/admin/prescriptions/create"> Add Prescription </a>
            </li>
        </ul>
    </li>

    <!--- Ending Admin Prescriptions --->

    <!--- Admin Pharamacies --->
    <li class="menu {{ request()->is('admin/upsaleitems*') ? 'active' : '' }}">
        <a href="/admin/upsaleitems" aria-expanded="false" class="dropdown-toggle">
            <div class="">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
            <span>Upsale Medicines</span>
            </div>
        </a>
    </li>
    <!--- Ending Admin Pharamacies --->

    <!--- Admin Transactions ---> 

    <li class="menu {{ request()->is('admin/transactions') ? 'active' : '' }}">
        <a href="/admin/transactions" aria-expanded="false" class="dropdown-toggle">
            <div class="">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
            <span>All Transactions</span>
            </div>
        </a>
    </li>
    <!--- Admin Transactions -->

    @endif

    <!--- ONLY Patients MENU --->
    @if(Auth::user()->user_role == 4)


    <!--- orders for patients ---> 

    <li class="menu {{ request()->is('patient/orders') ? 'active' : '' }}">
        <a href="/patient/orders" aria-expanded="false" class="dropdown-toggle">
            <div class="">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg>
            <span>All Orders</span>
            </div>
        </a>
    </li>
    <!--- ending orders -->

    <!--- Patients Transactions ---> 

    <li class="menu {{ request()->is('patient/transactions') ? 'active' : '' }}">
        <a href="/patient/transactions" aria-expanded="false" class="dropdown-toggle">
            <div class="">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg>
            <span>Transactions</span>
            </div>
        </a>
    </li>
    <!--- Patients Transactions -->

    @endif
    <!--- ONLY Patients MENU ENDING --->

    <!--- ONLY Doctors MENU --->
    @if(Auth::user()->user_role == 2)

    <!--- Doctors Orders ---> 
    <li class="menu {{ request()->is('doctor/orders') ? 'active' : '' }}">
        <a href="/doctor/orders" aria-expanded="false" class="dropdown-toggle">
            <div class="">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg>
            <span>All Orders</span>
            </div>
        </a>
    </li>
    <!--- ending doctors orders -->
    @endif

    <!--- Ending Only Doctors MENU --->

    <!--- ONLY Pharmacy Managers MENU --->
    @if(Auth::user()->user_role == 3)

    <!--- pharmacy Managers Orders ---> 
    <li class="menu {{ request()->is('pharmacy/orders') ? 'active' : '' }}">
        <a href="/pharmacy/orders" aria-expanded="false" class="dropdown-toggle">
            <div class="">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg>
            <span>All Orders</span>
            </div>
        </a>
    </li>
    <!--- ending pharmacy Managers orders -->

    @endif
    <!--- Ending Pharmacy Managers MENU --->
</ul>