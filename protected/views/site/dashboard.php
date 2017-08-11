<?php

if (Yii::app()->user->isSA() == 'sa') {
    $this->renderPartial('//site/_samenu', array('active_menu' => $this->active_menu, 'open_class' => $this->open_class, 'active_class' => $this->active_class));
} else if (Yii::app()->user->isCDS() == 'cds') {
    $this->renderPartial('//site/_cdsmenu', array('active_menu' => $this->active_menu, 'open_class' => $this->open_class, 'active_class' => $this->active_class));
} else if (Yii::app()->user->isGPU() == 'gpu') {
    $this->renderPartial('//site/_gpumenu', array('active_menu' => $this->active_menu, 'open_class' => $this->open_class, 'active_class' => $this->active_class));
} else if (Yii::app()->user->isCPS() == 'cps') {
    $this->renderPartial('//site/_cpsmenu', array('active_menu' => $this->active_menu, 'open_class' => $this->open_class, 'active_class' => $this->active_class));
} else if (Yii::app()->user->isOutletManager() == 'outlet_mgr') {
    $this->renderPartial('//site/_outletmenu', array('active_menu' => $this->active_menu, 'open_class' => $this->open_class, 'active_class' => $this->active_class));
} else if (Yii::app()->user->isTicketManager() == 'ticket_mgr') {
    $this->renderPartial('//site/_ticketmenu', array('active_menu' => $this->active_menu, 'open_class' => $this->open_class, 'active_class' => $this->active_class));
}
?>  