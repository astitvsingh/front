/**
 * Created by Nicolas on 10/10/2017.
 */

export let sessionMock = new function () {
  this.user = {
    guid: '1000',
    admin: true,
    plus: false,
    disabled_boost: false,
  };
  this.loggedIn = true;
  this.isAdmin = () => {
      return this.user.admin;
  };

  this.getLoggedInUser = () => {
    return this.user;
  };

  this.isLoggedIn = (fn) => {
    return this.loggedIn;
  };

  this.login = () => { };

  this.logout = () => { };
};
