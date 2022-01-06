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

    static checkAnyCookieActive() {
        return (this.adminCookieIsActive() || this.waiterCookieIsActive())
    }

    static adminCookieIsActive() {
        return (ck.isKey("admin_session") ? true : false)
    }

    static waiterCookieIsActive() {
        return (ck.isKey("waiter_session") ? true : false)
    }

    static removeCookies() {
        ck.remove("admin_session");
        ck.remove("waiter_session");
    }
}