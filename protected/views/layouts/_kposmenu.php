<li class="treeview <?php echo ($active_menu == 'aos') ? 'active' : ''; ?>">
    <a href="<?php echo $this->createUrl('kitchen/aos'); ?>">
        <span>AOS</span> 
    </a>  
</li>
<li class="treeview <?php echo ($active_menu == 'pkot') ? 'active' : ''; ?>">
    <a href="<?php echo $this->createUrl('kitchen/pkot'); ?>">
        <span>Production KOT</span> 
    </a>  
</li>
<li class="treeview <?php echo ($active_menu == 'mkot') ? 'active' : ''; ?>">
    <a href="<?php echo $this->createUrl('kitchen/mkot'); ?>">
        <span>Menu KOT</span> 
    </a>  
</li>
