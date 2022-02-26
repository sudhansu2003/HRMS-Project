$.fn.andSelf = function () {
    return this.addBack.apply(this, arguments);
}
