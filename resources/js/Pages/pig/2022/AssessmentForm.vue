<template>
  <div class="position-absolute top-0 min-vh-100 min-vw-100 bg-light">
    <!-- ################################# -->

    <div class="container mt-5">
      <!-- container start -->

      <Link href="/pig/2022/assessment-forms" v-if="!edit_form">
        <a class="btn btn-primary">View Encoded Forms</a>
      </Link>

      <Link href="/pig/2022/assessment-forms" v-if="edit_form">
        <a class="btn btn-danger">Cancel Edit</a>
      </Link>

      <!-- <button class="btn btn-danger ms-3" v-if="edit_form">Cancel Edit</button> -->

      <form @submit.prevent="submit()">
        <h3 class="text-center mb-5">
          Agri-extension Competency Gap Assessment Form
        </h3>
        <!-- name row start -->
        <div class="row">
          <div class="col">
            <div class="input-group flex-nowrap">
              <span class="input-group-text" id="addon-wrapping"
                >Pangalan:</span
              >
              <input
                type="text"
                class="form-control"
                placeholder="e.g. Josephine S. Amerila"
                aria-label="Pangalan"
                aria-describedby="addon-wrapping"
                :value="form.name.toUpperCase()"
                @input="form.name = $event.target.value.toUpperCase()"
                required
              />
            </div>
          </div>
          <div class="col">
            <div class="input-group flex-nowrap">
              <span class="input-group-text" id="addon-wrapping"
                >Function/Title:</span
              >
              <input
                type="text"
                class="form-control"
                placeholder="e.g. Sugarcane Technician XXX"
                aria-label="Function/Title"
                aria-describedby="addon-wrapping"
                :value="form.function_title.toUpperCase()"
                @input="form.function_title = $event.target.value.toUpperCase()"
                required
              />
            </div>
          </div>
        </div>
        <!-- name row end -->
        <!-- kadugayon start -->
        <div class="row pt-2">
          <div class="col">
            <div class="input-group">
              <span class="input-group-text"
                >Kadugayon sa serbisyo sa agri-extension:</span
              >
              <input
                type="number"
                min="0"
                aria-label="YOS AGRIEXT YRS"
                class="form-control"
                placeholder="0"
                v-model="form.yos_agri_extension"
              />
              <span class="input-group-text bg-white text-secondary"
                >Year/s</span
              >
              <input
                type="number"
                min="0"
                aria-label="YOS AGRIEXT MOS"
                class="form-control"
                placeholder="0"
                v-model="form.mos_agri_extension"
              />
              <span class="input-group-text bg-white text-secondary"
                >Month/s</span
              >
            </div>
          </div>
          <div class="col">
            <div class="input-group">
              <span class="input-group-text">Kadugayon sa posisyon karun:</span>
              <input
                type="number"
                min="0"
                aria-label="YOS AGRIEXT YRS"
                class="form-control"
                placeholder="0"
                v-model="form.yos_current_position"
              />
              <span class="input-group-text bg-white text-secondary"
                >Year/s</span
              >
              <input
                type="number"
                min="0"
                aria-label="YOS AGRIEXT MOS"
                class="form-control"
                placeholder="0"
                v-model="form.mos_current_position"
              />
              <span class="input-group-text bg-white text-secondary"
                >Month/s</span
              >
            </div>
          </div>
        </div>
        <!-- kadugayon end -->
        <!-- bio info start -->
        <div class="row pt-2">
          <div class="col-2">
            <div class="input-group flex-nowrap">
              <span class="input-group-text" id="addon-wrapping">Edad:</span>
              <input
                type="text"
                class="form-control"
                placeholder="Edad"
                aria-label="Edad"
                aria-describedby="addon-wrapping"
                v-model="form.age"
              />
            </div>
          </div>
          <div class="col-6">
            <!-- gender start -->
            <div class="input-group">
              <label class="input-group-text me-2">Gender:</label>
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="radio"
                  name="gender"
                  id="maleRadio"
                  value="male"
                  v-model="form.gender"
                />
                <label class="form-check-label" for="maleRadio">Male</label>
              </div>
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="radio"
                  name="gender"
                  id="femaleRadio"
                  value="female"
                  v-model="form.gender"
                  required
                />
                <label class="form-check-label" for="femaleRadio">Female</label>
              </div>
            </div>
            <!-- gender end -->
          </div>
        </div>
        <!-- bio info end -->
        <div class="mt-5"></div>
        <!-- competencies start -->
        <div v-for="(competency, i) in competencies" :key="competency.id">
          <h5>
            {{ letters[i].toUpperCase() }}. {{ get_title(competency.id) }}
          </h5>
          <ol>
            <li v-for="(question, q) in competency.questions" :key="q">
              {{ question.question }}
              <br />
              <!-- {{ `${letters[i]}_${competency.id}_${q}` }}
              <br /> -->
              <div
                class="form-check form-check-inline"
                v-for="(choice, c) in question.choices"
                :key="c"
              >
                <input
                  class="form-check-input"
                  type="radio"
                  :name="`${competency.id + q}`"
                  :id="`${competency.id + q + c}`"
                  :value="choice"
                  v-model="
                    form.competencies[`${letters[i]}_${competency.id}_${q}`]
                  "
                />
                <!-- v-model="form.competencies[i+q]" -->
                <label
                  class="form-check-label"
                  :for="`${competency.id + q + c}`"
                  >{{ `${choice[0].toUpperCase()}${choice.slice(1)}` }}</label
                >
              </div>
            </li>
          </ol>
        </div>
        <!-- competencies end -->
        <!-- additional info start -->

        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label"
            ><h5>
              I. Kung aduna kay ikadugang nga mga kahanas nga gikinahanglan sa
              agri-extension, apan wala gilista sa ibabaw, palihug isulat kini
              sa luna sa ubos.
            </h5></label
          >
          <textarea
            class="form-control"
            id="exampleFormControlTextarea1"
            rows="3"
            placeholder="..."
            v-model="form.i_additional_information"
          ></textarea>
        </div>

        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label"
            ><h5>
              J. Unsa ang angay nga mga pamaagi aron makuha ang nahisgutan sa
              itaas nga mga core competencies? Palihug i-rate ang matag paagi o
              mekanismo sa sukod nga gihatag sa ubos.
            </h5></label
          >

          <!-- table start -->
          <table class="table table-bordered mx-auto" style="font-size: 24px">
            <thead>
              <tr>
                <th>Mga pamaagi arun makuha ang core competencies</th>
                <th>Dili Angay</th>
                <th>Medyo Angay</th>
                <th>Angay</th>
                <th>Angayan Kaayo</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, j) in j_additional_questions" :key="j">
                <td>{{ j + 1 + ". " + item.question }}</td>
                <td
                  v-for="(choice, c) in item.choices"
                  :key="c"
                  style="width: 50px"
                >
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="radio"
                      :name="`j_item_${j}`"
                      :value="choice"
                      v-model="
                        form.j_additional_information[
                          `j_additional_information_${j}`
                        ]
                      "
                    />
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <!-- table end -->
        </div>

        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">
            <h5>
              K. Kung magrekomenda ka ug tulo pa nga mga kalihokan o programa
              aron mapauswag ang mga core competencies sa mga agri-extension
              professionals unsa ang imong mga rekomendasyon?
            </h5>
          </label>
          <textarea
            class="form-control"
            id="exampleFormControlTextarea1"
            rows="3"
            placeholder="..."
            v-model="form.k_additional_information"
          ></textarea>
        </div>

        <button
          :disabled="form.processing"
          class="btn btn-primary"
          type="submit"
        >
          Submit
        </button>

        <!-- additional info end -->
      </form>
      <!-- container end -->
    </div>

    <!-- ################################# -->
  </div>
</template>

<script>
import BreezeApplicationLogo from "@/Components/ApplicationLogo";
// import { Link } from "@inertiajs/inertia-vue3";
import { Link } from "@inertiajs/inertia-vue3";
export default {
  props: {
    edit_form: Object,
  },
  components: {
    BreezeApplicationLogo,
    Link,
  },
  data() {
    return {
      form: this.$inertia.form({
        id: "",
        name: "",
        function_title: "",
        yos_agri_extension: "",
        mos_agri_extension: "",
        yos_current_position: "",
        mos_current_position: "",
        age: "",
        gender: "",
        competencies: {},
        i_additional_information: "",
        j_additional_information: {},
        k_additional_information: "",
      }),
      letters: ["a", "b", "c", "d", "e", "f", "g", "h"],
      competencies: [
        {
          id: "program_planning",
          questions: [
            {
              question:
                "Pamilyar ba kamo sa panan-awon, misyon, programa, mga palisiya ug mga tumong sa mga serbisyo sa agri-extension.",
              choices: ["oo", "medyo", "dili"],
            },
            {
              question:
                "Makahimo sa pagpa-apil sa mga hingtungdan sa pagpahigayon sa mga pagtimbang-timbang sa mga panginahanglan.",
              choices: ["oo", "medyo", "dili"],
            },
            {
              question:
                "Makahimo sa pagpa-apil sa mga local development partners sama sa NGOs, women groups, ug kooperatiba sa extension program.",
              choices: ["oo", "medyo", "dili"],
            },
          ],
        },
        {
          id: "program_implementation",
          questions: [
            {
              question:
                "Pag-pakita ug kahanas sa pagtinabangay aron makab-ot ang mga resulta sa agri-extension.",
              choices: ["oo", "medyo", "dili"],
            },
            {
              question:
                "Pag-apil sa mga lokal nga stakeholders sa pagpatuman sa mga kalihokan sa agri-extension program.",
              choices: ["oo", "medyo", "dili"],
            },
            {
              question:
                "Ipakita ang mga kahanas sa negosasyon aron makab-ot ang konsensus ug masulbad ang mga panagbangi.",
              choices: ["oo", "medyo", "dili"],
            },
            {
              question:
                "Pagtugyan sa mga responsibilidad ngadto sa mga kauban kon gikinahanglan.",
              choices: ["oo", "medyo", "dili"],
            },
            {
              question:
                "Makahimo sa pag-apil sa mga babaye nga mag-uuma ug mga miyembro sa minorya nga mga grupo sa mga buluhaton sa agri-extension.",
              choices: ["oo", "medyo", "dili"],
            },
          ],
        },
        {
          id: "communication_skills",
          questions: [
            {
              question:
                "Pagtahud sa mga lokal nga kultura samtang nakigsulti sa mga kliyente.",
              choices: ["oo", "medyo", "wala"],
            },
            {
              question:
                "Pag-andam matag bulan/quarterly/tinuig nga mga progress reports sa mga trabaho sa agri-extension.",
              choices: ["oo", "medyo", "wala"],
            },
            {
              question:
                "Pagpaambit sa mga impormasyon sa kalampusan ug mga leksyon nga nakat-unan sa mga stakesholder pinaagi sa mga nagkalain-laing media.",
              choices: ["oo", "medyo", "wala"],
            },
            {
              question:
                "Paggamit ug nagkalain-laing mga agianan sa komunikasyon aron ipakaylap ang impormasyon bahin sa importanteng mga kalihokan ug programa sa agri-extension (pananglitan, adlaw sa uma sa mga mag-uuma, epidemya sa sakit ug peste).",
              choices: ["oo", "medyo", "wala"],
            },
            {
              question:
                "Pagbaton ug kahanas sa maayo nga pagpaminaw sa tanang kliyente ug stakeholders.",
              choices: ["oo", "medyo", "wala"],
            },
            {
              question: "Pagpakita ug kahanas sa pagsulti sa publiko.",
              choices: ["oo", "medyo", "wala"],
            },
          ],
        },
        {
          id: "education_and_information_technology",
          questions: [
            {
              question:
                "Paggamit ug Microsoft excel alang sa data entry ug data analysis.",
              choices: ["oo", "wala"],
            },
            {
              question:
                "Paggamit ug Microsoft Word alang sa word processing (e.g. pag-type, pag-edit, pag-imprenta) ug graphic design.",
              choices: ["oo", "wala"],
            },
            {
              question:
                "Paggamit ug Microsoft Powerpoint aron sa paghimo og mga presentasyon.",
              choices: ["oo", "wala"],
            },
            {
              question:
                "Paggamit ug Audio-visual aid sama sa mga tsart, mga graph, ug mga puppet show alang sa pagtudlo ug pagkat-on.",
              choices: ["oo", "wala"],
            },
            {
              question:
                "Paggamit ug mass media sama sa mga estasyon sa radyo sa FM ug mga channel sa telebisyon alang sa komunikasyon.",
              choices: ["oo", "wala"],
            },
            {
              question:
                "Paggamit ug kompyuter (email, internet, ug mga webpage) para sa komunikasyon.",
              choices: ["oo", "wala"],
            },
            {
              question:
                "Paggamit ug mobile phone services (pananglitan, pag-text, serbisyo sa SMS) para sa komunikasyon.",
              choices: ["oo", "wala"],
            },
            {
              question:
                "Paggamint sa mga modernong kahimanan sa paghimo sa fieldwork (GPS, Soil Tester, pH meter).",
              choices: ["oo", "wala"],
            },
          ],
        },
        {
          id: "program_evaluation",
          questions: [
            {
              question:
                "Pagpahigayon ug monitoring and evaluation sa agri-extension programs.",
              choices: ["oo", "wala"],
            },
            {
              question:
                "Pagpalambo og mga instrumento sa pagkolekta sa datos gikan sa pagmonitor ug pagtimbang-timbang sa mga trabaho sa agri-extension.",
              choices: ["oo", "wala"],
            },
            {
              question:
                "Pag-apply sa mga qualitative tools and techniques (pananglitan, focus group discussion, in-depth interview, etc.) aron makolekta ang evaluation data.",
              choices: ["oo", "wala"],
            },
            {
              question:
                "Pag-apply ug quantitative tools and techniques (pananglitan, survey, interbyu, datos sa uma) aron makolekta ang evaluation data.",
              choices: ["oo", "wala"],
            },
            {
              question:
                "Pag-analisar sa datos (kwalitatibo ug quantitative), paghubad sa datos, ug pagsulat sa evaluation report.",
              choices: ["oo", "wala"],
            },
            {
              question:
                "Pagpaambit sa evaluation report sulod sa organisasyon ug sa mga stakeholders.",
              choices: ["oo", "wala"],
            },
          ],
        },
        {
          id: "personal_and_professional_development",
          questions: [
            {
              question:
                "Pagpraktis sa mga prinsipyo sa good governance (pananglitan, partisipasyon sa mga kliyente, tulubagon sa mga kliyente, transparency).",
              choices: ["oo", "wala"],
            },
            {
              question:
                "Pagpakita ug pasalig sa pag-uswag sa karera (participate in lifelong-learning, in-service training programs, propesyonal nga miting, ug mga komperensya.",
              choices: ["oo", "wala"],
            },
            {
              question:
                "Pag-apply ug propesyonal nga pamatasan sa trabaho, ie, ipasiugda ang rekomendasyon nga nakabase sa panukiduki o teknolohiya, pagkamatinud-anon, ug integridad.",
              choices: ["oo", "wala"],
            },
            {
              question:
                "Pagsunod sa mga polisiya ug direktiba sa organisasyon alang sa in-service training ug professional development.",
              choices: ["oo", "wala"],
            },
            {
              question: "Nagakuha ug post-grad studies, CSC/Board Exams?",
              choices: ["oo", "wala"],
            },
          ],
        },
        {
          id: "diversity",
          questions: [
            {
              question:
                "Pagsabot nga ang pagkalain-lain (diversity) anaa sa sulod ug taliwala sa mga kliyente ug mga stakeholder.",
              choices: ["oo", "medyo", "wala"],
            },
            {
              question:
                "Pag-ila sa mga panginahanglan sa kababayen-an, gagmay nga mga mag-uuma, ug minoriya nga mga grupo.",
              choices: ["oo", "medyo", "wala"],
            },
            {
              question:
                "Pag-develop sa mga agri-extension programs aron makabenepisyo ang mga babayeng mag-uuma.",
              choices: ["oo", "medyo", "wala"],
            },
            {
              question:
                "Pag-paapil sa nagkalain-laing social ug marginalized nga mga grupo sa agri-extension programs.",
              choices: ["oo", "medyo", "wala"],
            },
            {
              question:
                "Pagtinabangay uban ang nagkadaiyang empleyado sa departamento.",
              choices: ["oo", "medyo", "wala"],
            },
          ],
        },
        {
          id: "technical_subject_matter_expertise",
          questions: [
            {
              question:
                "Pagpakita nga sila adunay sukaranan nga kahibalo sa ilang disiplina (eg, mga tanum, kahayupan, IPM, ug uban pa).",
              choices: ["oo", "medyo", "wala"],
            },
            {
              question:
                "Pagsabot sa bag-ong teknolohiya nga gipasiugda, i.e., unsa kini, ngano, ug giunsa kini paglihok.",
              choices: ["oo", "medyo", "wala"],
            },
            {
              question:
                "Makahimo sa pag-edukar sa mga miyembro sa komunidad mahitungod sa lain-laing mga matang sa mga risgo ug kawalay kasiguruhan (tungod sa pagbag-o sa klima, pag-usab-usab sa merkado, ug mga katalagman).",
              choices: ["oo", "medyo", "wala"],
            },
            {
              question:
                "Pagtan-aw ug paggamit sa mga publikasyon -- mga journal, mga research reports, ug uban pa.",
              choices: ["oo", "medyo", "wala"],
            },
            {
              question:
                "Pagpakita ug sukaranan nga kahibalo sa mga agribusiness, ug pagtabang sa pagpalambo sa entrepreneurship sa mga kliyente.",
              choices: ["oo", "medyo", "wala"],
            },
          ],
        },
      ],
      j_additional_questions: [
        {
          question: "Preservice training",
          choices: ["dili_angay", "medyo_angay", "angay", "angayan_kaayo"],
        },
        {
          question: "In-service training",
          choices: ["dili_angay", "medyo_angay", "angay", "angayan_kaayo"],
        },
        {
          question: "Basic induction training",
          choices: ["dili_angay", "medyo_angay", "angay", "angayan_kaayo"],
        },
        {
          question:
            "National and international serminars, workshops, webinars, etc.",
          choices: ["dili_angay", "medyo_angay", "angay", "angayan_kaayo"],
        },
      ],
    };
  },
  // watch: {
  //   edit_form(form) {
  //     this.form.name = form.name
  //   },
  // },
  methods: {
    get_title(competency_id) {
      var title = _.toUpper(competency_id);
      return title;
    },
    submit() {
      // console.log(this.form);
      this.form.post("/pig/2022/assessment-form", {
        onSuccess: (page) => {
          console.log(page);
          this.form.reset();
          // this.$inertia.visit("/");
        },
      });
    },
    set_edit_form() {
      if (!this.edit_form) return false;
      this.form = this.$inertia.form(this.edit_form)
    },
  },
  mounted() {
    console.log(this.edit_form);
    this.set_edit_form();
  },
};
</script>