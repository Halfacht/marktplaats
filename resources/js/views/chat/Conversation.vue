<template>
  <div class="container">
    <template v-for="message in conversation">
      <div
        class="row mb-3"
        :class="{ 'justify-content-end': message.receiver.id === currentId }"
      >
        <div class="col-8">
          <div class="card">
            <div class="card-body">
              <p class="mb-0">{{ message.content }}</p>
              <span class="float-end text-muted">{{ message.created_at }}</span>
            </div>
          </div>
        </div>
      </div>
    </template>

    <form-component :form="form" class="row">
      <div class="col-10">
        <input
          v-model="form.data.content"
          type="text"
          class="form-control border border-primary"
          :class="{ 'is-invalid': form.errors.get('content') }"
          name="content"
          id="content"
        />
      </div>
      <div class="col-2">
        <button
          class="btn btn-primary w-100 h-100"
          :disabled="form.isDisabled()"
          @click.prevent="submit"
        >
          Send
        </button>
      </div>
    </form-component>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import FormComponent from "../../components/parts/FormComponent.vue";

export default {
  components: { FormComponent },
  props: ["id"],

  data() {
    return {
      form: new Form({
        content: "",
        receiver_id: this.id,
      }),
    };
  },

  computed: {
    ...mapGetters(["conversation"]),
    currentId() {
      return parseInt(this.id);
    },
  },

  methods: {
    submit() {
      this.form.action("storeMessage");
    },
  },

  created() {
    this.$store.dispatch("getConversation", this.id);
  },
};
</script>