function SetHome(obj,vrl){
        try{
            obj.style.behavior='url(#default#homepage)';obj.setHomePage(vrl);
            }
        catch(e){
                if(window.netscape) {
                        try { 
						netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");  
                        }  
                        catch (e){ 
                                alert("Your Browser does not support ");
                        }
                        var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
                        prefs.setCharPref('browser.startup.homepage',vrl);
                 }
        }
}

function addFavorite(){
    var vDomainName=window.location.href;
    var description=document.title;
    try{//IE
        window.external.AddFavorite(vDomainName,description);
    }catch(e){//FF
        window.sidebar.addPanel(description,vDomainName,"");
    }
}
