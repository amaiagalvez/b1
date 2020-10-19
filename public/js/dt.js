var footerTotal="",height_content=document.body.offsetHeight/2;height_content>550&&(height_content=550),height_content+="px";var handleCheckboxes=function(t,e,a,o){var n=$(o),s=n.find(":checked");return s.length?1===s.val()?"Yes":"No":n.text()};function initMenuDataTables(t,e,a){window.dtOptions=window.dtDefaultOptions;let o=window.location.search,n="";window.dtOptions.columns=[{title:"",data:"actions",name:"actions",orderable:!1,searchable:!1,width:"10%"},{title:menuWords.id,data:id,name:id,width:"20%"},{title:menuWords.name,data:name,name:name,width:"20%"},{title:dtWords.order,data:"order",name:"order",visible:!1}],"index"===t&&(n=a+o),window.dtOptions.language=e,window.dtOptions.oLanguage.sUrl="/basics/js/dt_"+e+".json",window.dtOptions.serverSide=!0,window.dtOptions.order=[1,"asc"],window.dtOptions.ajax=n,$("#dt_ajx").DataTable(window.dtOptions)}function initRoleDataTables(t,e,a,o,n){window.dtOptions=window.dtDefaultOptions;let s=window.location.search,d="",i="title_"+e,l="notes_"+e;window.dtOptions.columns=[{title:"",data:"actions",name:"actions",orderable:!1,searchable:!1,width:"10%"},{title:roleWords.rola,data:i,name:i},{title:roleWords.short_name,data:"name",name:"name"},{title:dtWords.notes,data:l,name:l,width:"20%"}],"index"===t&&(d=a+s),"trash"===t&&(d=n+s,window.dtOptions.columns.push({title:dtWords.when,data:"deleted_at",name:"deleted_at"},{title:dtWords.who,data:"deletedBy.data.name",name:"deletedBy.name",orderable:!1,searchable:!1})),"nonactive"===t&&(d=o+s,window.dtOptions.columns.push({title:dtWords.when,data:"updated_at",name:"updated_at"},{title:dtWords.who,data:"updatedBy.data.name",name:"updatedBy.name",orderable:!1,searchable:!1})),window.dtOptions.language=e,window.dtOptions.oLanguage.sUrl="/basics/js/dt_"+e+".json",window.dtOptions.serverSide=!0,window.dtOptions.order=[1,"asc"],window.dtOptions.ajax=d,$("#dt_ajx").DataTable(window.dtOptions)}function initSessionDataTables(t,e,a){window.dtOptions=window.dtDefaultOptions;let o=window.location.search,n="";window.dtOptions.columns=[{title:"",data:"actions",name:"actions",orderable:!1,searchable:!1,width:"1%"},{title:sessionWords.user,data:"user.data.name",name:"user.name"},{title:sessionWords.login_at,data:"login_at",name:"login_at"},{title:sessionWords.logout_at,data:"logout_at",name:"logout_at"},{title:sessionWords.total,data:"total",name:"total",orderable:!1,searchable:!1},{title:sessionWords.ip_address,data:"ip_address",name:"ip_address"},{title:sessionWords.user_agent,data:"user_agent",name:"user_agent",width:"20%"}],"index"===t&&(n=a+o),window.dtOptions.language=e,window.dtOptions.oLanguage.sUrl="/basics/js/dt_"+e+".json",window.dtOptions.serverSide=!0,window.dtOptions.order=[2,"desc"],window.dtOptions.ajax=n,$("#dt_ajx").DataTable(window.dtOptions)}function initUserDataTables(t,e,a,o,n){window.dtOptions=window.dtDefaultOptions;let s=window.location.search,d="";window.dtOptions.columns=[{title:"",data:"actions",name:"actions",orderable:!1,searchable:!1,width:"10%"},{title:userWords.name,data:"name",name:"name"},{title:userWords.email,data:"email",name:"email"},{title:dtWords.lang,data:"lang",name:"lang",className:"text-center"},{title:userWords.role_name,data:"role_name",name:"role_name",className:"text-center"},{title:userWords.sessions_count,data:"sessions_count",name:"sessions_count",searchable:!1,className:"text-center"},{title:dtWords.notes,data:"notes",name:"notes",width:"20%"}],"index"===t&&(d=a+s),"trash"===t&&(d=o+s,window.dtOptions.columns.push({title:dtWords.when,data:"deleted_at",name:"deleted_at"},{title:dtWords.who,data:"deletedBy.data.name",name:"deletedBy.name",orderable:!1,searchable:!1})),"nonactive"===t&&(d=n+s,window.dtOptions.columns.push({title:dtWords.when,data:"updated_at",name:"updated_at"},{title:dtWords.who,data:"updatedBy.data.name",name:"updatedBy.name",orderable:!1,searchable:!1})),window.dtOptions.language=e,window.dtOptions.oLanguage.sUrl="/basics/js/dt_"+e+".json",window.dtOptions.serverSide=!0,window.dtOptions.order=[1,"asc"],window.dtOptions.ajax=d,$("#dt_ajx").DataTable(window.dtOptions)}function initVariableDataTables(t,e,a){window.dtOptions=window.dtDefaultOptions;let o=window.location.search,n="",s="title_"+e,d="notes_"+e;window.dtOptions.columns=[{title:"",data:"actions",name:"actions",orderable:!1,searchable:!1,width:"10%"},{title:variableWords.variable,data:s,name:s,width:"20%"},{title:variableWords.value,data:"value",name:"value",className:"text-center"},{title:dtWords.notes,data:d,name:d,width:"20%"},{title:dtWords.order,data:"order",name:"order",visible:!1}],"index"===t&&(n=a+o),window.dtOptions.language=e,window.dtOptions.oLanguage.sUrl="/basics/js/dt_"+e+".json",window.dtOptions.serverSide=!0,window.dtOptions.order=[4,"asc"],window.dtOptions.ajax=n,$("#dt_ajx").DataTable(window.dtOptions)}window.dtDefaultOptions={oLanguage:{sUrl:"/js/dt_translations_eu.js"},scrollX:!0,scrollY:height_content,scrollCollapse:!0,retrieve:!0,processing:!0,deferRender:!0,dom:'<<"top"fr><t><"bottom"Blip>>',responsive:!0,aaSorting:[],select:!0,stateSave:!0,iDisplayLength:10,pageLength:10,aLengthMenu:[[10,20,25,50,100,-1],[10,20,25,50,100,"All"]],pagingType:"full_numbers",footerCallback:function(t,e,a,o,n){var s=this.api(),d=function(t){return"string"==typeof t?1*t.replace(/[\€.]/g,"").replace(",","."):"number"==typeof t?t:0};if(""!=footerTotal)for(var i=(footerTotal+="").split(","),l=0;l<i.length;l++)columnNb=i[l],total=s.column(columnNb).data().reduce(function(t,e){return d(t)+d(e)},0),showTotal=s.column(columnNb,{page:"current"}).data().reduce(function(t,e){return d(t)+d(e)},0),showTotal=Number(showTotal).toFixed(2),dezimalak=showTotal.split("."),0==dezimalak[1]&&(showTotal=dezimalak[0]),totala=Number(total).toFixed(2),dezimalak=totala.split("."),0==dezimalak[1]&&(totala=dezimalak[0]),$(s.column(columnNb).footer()).html('<span class="theme-color">'+formatuakZbkia(showTotal)+" ("+formatuakZbkia(totala)+")</span>")},buttons:[{extend:"colvis",autoClose:!0,postfixButtons:["colvisRestore"],text:'<i class="fas fa-columns" aria-hidden="true"></i> Zutabeak',collectionLayout:"two-column",columns:":not(:first-child):not(:last-child)"},{extend:"csv",text:'<i class="fas fa-file-csv" aria-hidden="true"></i> CSV ',charset:"utf-8",bom:!0,exportOptions:{columns:":visible",modifier:{order:"applied",page:"all",search:"applied"}}}]},$(".datatable").each(function(){$(this).hasClass("dt-select")&&(window.dtDefaultOptions.select={style:"multi",selector:"td:first-child"},window.dtDefaultOptions.columnDefs.push({orderable:!1,className:"select-checkbox",targets:0}))}),void 0!==window.route_mass_crud_entries_destroy&&$(".datatable, .ajaxTable").siblings(".actions").html('<a href="'+window.route_mass_crud_entries_destroy+'" class="btn btn-xs btn-danger js-delete-selected" style="margin-top:0.755em;margin-left: 20px;">Delete selected</a>'),$(document).on("click",".js-delete-selected",function(){if(confirm("Are you sure")){var t=[];$(this).closest(".actions").siblings(".datatable, .ajaxTable").find("tbody tr.selected").each(function(){console.log("selected",$(this).data("entry-id")),t.push($(this).data("entry-id"))}),$.ajax({method:"POST",url:$(this).attr("href")+"/?ids="+t}).done(function(){location.reload()})}return!1}),$(document).on("click","#select-all",function(){var t=$(this).is(":checked");$(this).closest("table.datatable, table.ajaxTable").find("td:first-child").each(function(){t!=$(this).closest("tr").hasClass("selected")&&$(this).click()})}),$(".mass").click(function(){$(this).is(":checked")?$(".single").each(function(){0==$(this).is(":checked")&&$(this).click()}):$(".single").each(function(){1==$(this).is(":checked")&&$(this).click()})});
