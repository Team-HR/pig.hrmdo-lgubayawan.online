<template>
  <div class="position-absolute top-0 min-vh-100 min-vw-100 bg-light">
    <!-- ################################# -->

    <div class="container mx-auto">
      <div class="card m-5">
        <!-- <img src="" class="card-img-top" alt="..." /> -->
        <div class="card-body">
          <h1 class="card-title">
            {{
              "Competency Gap Assessment on Agri-Extension Technicians of LGU Bayawan City".toUpperCase()
            }}
          </h1>
          <h3 class="card-subtitle mb-2 text-muted">2022 VAC:PIG</h3>

          <p class="card-text">
            <!-- Some quick example text to build on the card title and make up the
            bulk of the card's content. -->
          </p>
          <!-- <a href="#" class="btn btn-success">Go to Assessment Form</a> -->
          <Link href="/pig/2022/assessment-form">
            <a class="btn btn-success">Go to Assessment Form</a>
          </Link>

          <a href="#" class="btn btn-primary disabled ms-2">Go to Report</a>

          <button @click="$inertia.get('/pig/2022/assessment-forms')">TEST</button>
        </div>
      </div>
    </div>

    <!-- ################################# -->
  </div>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";
export default {
  components: {
    Link,
  },
};
</script>