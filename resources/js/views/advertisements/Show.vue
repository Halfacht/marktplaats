<template>
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <h1>{{ advertisement.title }}</h1>
            <p>{{ advertisement.createdAt }}</p>
          </div>
          <div class="card-body">
            <p>{{ advertisement.content }}</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="row mb-3">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <p>{{ advertisement.owner?.name }}</p>
              </div>
              <div class="card-body">
                <p>{{ advertisement.owner?.town }}</p>
                <p v-if="advertisement.owner?.distance">
                  {{ advertisement.owner.distance }} km
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <p>Biddings</p>
                <form-component :form="form" v-if="auth">
                  <div class="form-floating mb-2">
                    <input
                      class="form-control"
                      name="amount"
                      id="amount"
                      type="text"
                      v-model="form.data.amount"
                    />
                    <label for="amount" class="form-label">€</label>
                    <!-- <form-error :error="form.errors.get('amount')"></form-error> -->
                  </div>

                  <button
                    :disabled="form.isDisabled()"
                    class="btn btn-success mx-auto d-block"
                    style="width: 150px"
                    @click.prevent="submit"
                  >
                    Place Bidding
                  </button>
                </form-component>
                <success-message
                  :message="form.successMessage"
                ></success-message>
              </div>
              <div class="card-body">
                <table class="table table-light table-striped table-bordered">
                  <tbody>
                    <template v-for="bidding in advertisement.biddings">
                      <tr>
                        <td>{{ bidding.name }}</td>
                        <td>€ {{ bidding.amount }}</td>
                        <td>{{ bidding.date }}</td>
                      </tr>
                    </template>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import SuccessMessage from "../../components/parts/SuccessMessage.vue";
import FormComponent from "../../components/parts/FormComponent.vue";
import FormError from "../../components/parts/FormError.vue";

export default {
  components: { FormComponent, FormError, SuccessMessage },

  props: ["id"],

  data() {
    return {
      form: new Form({
        amount: "",
		advertisement_id: this.id,
      }),
    };
  },

  computed: {
    ...mapGetters(["advertisement", "auth"]),
  },

  methods: {
    submit() {
		console.log('submitting');
		
      this.form.action("storeBidding");
    },
  },

  created() {
	  this.$store.dispatch('getAdvertisement', this.id)
  }
};
</script>