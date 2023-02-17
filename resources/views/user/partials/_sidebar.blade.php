<nav class="iq-sidebar-menu">
    <ul id="iq-sidebar-toggle" class="iq-menu">
        <li class="active">
            <a href="{{ route('dashboard') }}" class="iq-waves-effect"><i
                    class="las la-home iq-arrow-left"></i><span>Dashboard</span></a>
        </li>

     


 

 




  
       
            <li class="{{ request()->route()->getName() == 'member.stats'? 'active': '' }}">
                <a href="{{ route('member.stats') }}" class="iq-waves-effect"><i
                        class="las la-tools iq-arrow-left"></i><span>Stats</span></a>
            </li>

  
        

    </ul>
</nav>
<div class="p-3"></div>
