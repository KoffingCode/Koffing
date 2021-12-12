const ck = require('vue-cookies');
import router from '../router';

export default class CookieControl {
    static checkAdminCookieIsActive(func) {
        if(this.adminCookieIsActive()) {
            func();
        } else {
            router.push('/')
        }
    }

    static adminCookieIsActive() {
        return (ck.isKey("admin_session") ? true : false)
    }
}