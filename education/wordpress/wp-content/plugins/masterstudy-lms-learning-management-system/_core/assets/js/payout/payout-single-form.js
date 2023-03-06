"use strict";

new Vue({
  el: "#stm-payout-form",
  data: {
    mesage: null,
    loader: false
  },
  methods: {
    pay_now: function pay_now(id) {
      var vm = this;
      vm.loader = true;
      vm.mesage = null;
      this.$http.get(stm_payout_form_url_data['url'] + '/stm-lms-pauout/pay-now/' + id).then(function (response) {
        vm.loader = false;

        if (response.body.success) {
          location.reload();
          vm.mesage = response.body.message;
        } else {
          vm.mesage = response.body.message;
        }
      });
    },
    payed: function payed(id) {
      var vm = this;
      vm.loader = true;
      vm.mesage = null;
      this.$http.get(stm_payout_form_url_data['url'] + '/stm-lms-pauout/payed/' + id).then(function (response) {
        vm.loader = false;

        if (response.body.success) {
          location.reload();
          vm.mesage = response.body.message;
        } else {
          vm.mesage = response.body.message;
        }
      });
    }
  }
});