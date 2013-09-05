(function () {

    // system settings screen
    Mousetrap.bind(['command+shift+c', 'ctrl+shift+c'], function() {
        window.location = adminPath + 'config/';
        return false;
    });
    
    // manage permissions screen
    Mousetrap.bind(['command+shift+1', 'ctrl+shift+1'], function() {
        window.location = adminPath + 'manage_perms/';
        return false;
    });
    
    // add permissions screen
    Mousetrap.bind(['command+shift+2', 'ctrl+shift+2'], function() {
        window.location = adminPath + 'add_perm/';
        return false;
    });
    
     // manage roles screen
    Mousetrap.bind(['command+alt+3', 'ctrl+alt+3'], function() {
        window.location = adminPath + 'manage_roles/';
        return false;
    });
    
    // add role screen
    Mousetrap.bind(['command+alt+4', 'ctrl+alt+4'], function() {
        window.location = adminPath + 'add_role/';
        return false;
    });
    
     // add audit trail screen
    Mousetrap.bind(['command+shift+5', 'ctrl+shift+5'], function() {
        window.location = adminPath + 'audit_trail/';
        return false;
    });
    
    // add sql terminal screen
    Mousetrap.bind(['command+shift+6', 'ctrl+shift+6'], function() {
        window.location = adminPath + 'sql/';
        return false;
    });
    
}) ();