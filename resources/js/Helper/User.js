import Token from './Token';
import AppStorage from './AppStorage';

class User {

    login(formdata) {
        axios.post("/api/auth/login", formdata)
            .then(res => this.responseAfterLogin(res))
            .catch(error => console.log(error.response.data));
    }


    responseAfterLogin(res) {
        const access_token = res.data.access_token;
        const username = res.data.user;
        //  console.log('U: ' + access_token);
        if (Token.isValid(access_token)) {
            //  console.log('V T: ' + access_token);
            AppStorage.store(username, access_token);
            window.location = '/forum';
        }
    }

    hasToken() {
        const storedToken = AppStorage.getToken();
        if (storedToken) {
            return Token.isValid(storedToken) ? true : this.logOut();
        }
        return false;
    }

    loggedIn() {
        return this.hasToken();

    }
    logOut() {
        AppStorage.clear();
        window.location = '/forum';
    }
    name() {
        if (this.loggedIn()) {
            return AppStorage.getUser();
        }
    }
    id() {
        if (this.loggedIn()) {
            const payload = Token.payload(AppStorage.getToken())
            return payload.sub;
        }
    }
    own(id) {
        return this.id() == id;
    }
    admin() {
        return this.id() == 11;
    }

}

export default User = new User();
