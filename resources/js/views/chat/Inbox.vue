<template>
  <div class="container">
    <div class="row">
      <div class="col">
        <h1>Inbox</h1>
      </div>
    </div>

    <div class="row mb-5">
      <div class="col">
        <div class="card">
          <ul class="list-group list-group-flush">
            <li class="list-group-item" v-for="conversation in conversations">
              <router-link
                class="h4"
                :to="{
                  name: 'conversation',
                  params: { id: conversation.user_id },
                }"
              >
                {{ conversation.name }}
              </router-link>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters(["conversations"]),
  },
};
</script>