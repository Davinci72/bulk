<div class="ibox-content">
<div class="row">
<div class="col-sm-12">
<div class="hr-line-dashed"></div>
<form action="" role="form" class="form-inline" method="post">
    <div class="form-group" id="data_5">
                                
                                <div class="input-daterange input-group" id="datepicker">
                                   <span class="input-group-addon">From >></span><span class="input-group-addon"><i class="fa fa-calendar"></i></span> <input type="text" class="input-sm form-control" name="start" value="05/14/2014"/>
                                   <span class="input-group-addon">to >></span><span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                                    <input type="text" class="input-sm form-control" name="end" value="05/22/2014" />
                                </div>
                            </div>
    
                <div class="input-group">
                <select class="input-sm chosen-select" style="width:150px;"  tabindex="2">
                <option value="">All Senders</option>
                <option value="United States">GENERATIONS</option>
                <option value="United Kingdom">TEXTiFY</option>
                </select>
                </div>
                <div class="input-group">
                <select data-placeholder="Choose a Country..." class="chosen-select" style="width:150px;"  tabindex="2">
                <option value="">All Receipients</option>
                <option value="United States">GENERATIONS</option>
                <option value="United Kingdom">TEXTiFY</option>
                </select>
                </div>
    <div class="form-group">
        <input type="text" placeholder="Message Text" class="input-sm form-control">
    </div>
    <div class="input-group">
                <select data-placeholder="Choose a Country..." class="chosen-select" style="width:150px;"  tabindex="2">
                <option value="">Status</option>
                <option value="United States">Deliverd</option>
                <option value="United Kingdom">Scheduled</option>
                </select>
                </div>
    <button class="btn btn-success" type="submit">Search <i class="fa fa-search"></i></button>
</form>
<div class="hr-line-dashed"></div>
 <form>
      <? $options->viewSmsOut(); ?>
    </form>
</div>
</div>
<div class="ibox-content">
    <form>
        <div class="col-sm-9"></div>
        <div class="col-sm-2">
            <select class="form-control m-b" name="account">
                <option>Edit</option>
                <option>Move To Trash</option>
            </select>
</div>
            <button type="button" class="btn btn-outline btn-primary">Apply</button>
    </form>
    <div class="hr-line-dashed"></div>
 
</div>
</div>
</div>  
</div>
