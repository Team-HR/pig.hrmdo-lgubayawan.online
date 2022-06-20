<template>
  <guest-layout></guest-layout>
  <div class="container mx-auto px-10 mt-2 mb-10">
    <!-- ################################# -->
    <i-button class="btn-primary" @click="$inertia.get('/')" v-if="!edit_form"
      >Home</i-button
    >
    <i-button
      @click="$inertia.get('/pig/2022/assessment-forms')"
      v-if="!edit_form"
      class="ml-2 btn-primary"
      >View Encoded Forms</i-button
    >

    <i-button
      @click="$inertia.get('/pig/2022/assessment-forms')"
      v-if="edit_form"
      class="ml-2 btn-danger"
      >Cancel Edit</i-button
    >

    <i-toast ref="successToast">Saved!</i-toast>

    <form method="post" @submit.prevent="submit()" class="mt-5 mx-20">
      <!-- 
        <h1 class="text-center mb-5 font-semibold text-xl uppercase">
          Agri-extension Competency Gap Assessment Form
        </h1> 
      -->
      <div class="md:flex md:items-center mb-6">
        <div class="m-1 md:w-1/2">
          <i-label>Pangalan:</i-label>
          <i-input
            class="uppercase"
            type="text"
            placeholder="e.g. Josephine S. Amerila"
            v-model="form.name"
            required
          />

          <!-- 
            :value="form.name.toUpperCase()"
            @input="form.name = $event.target.value.toUpperCase()" 
          -->
        </div>
        <div class="m-1 md:w-1/2">
          <i-label>Function/Title:</i-label>
          <i-input
            class="uppercase"
            type="text"
            placeholder="e.g. Sugarcane Technician XXX"
            v-model="form.function_title"
            required
          />
        </div>
      </div>

      <div class="md:flex md:items-center">
        <div class="m-1 md:w-1/2">
          <i-label>Kadugayon sa serbisyo sa agri-extension:</i-label>

          <div class="md:flex md:items-center mb-6">
            <i-input
              class="m-1"
              type="number"
              min="0"
              placeholder="Years"
              v-model="form.yos_agri_extension"
            />

            <i-input
              class="m-1"
              type="number"
              min="0"
              placeholder="Months"
              v-model="form.mos_agri_extension"
            />
          </div>
        </div>
        <div class="m-1 md:w-1/2">
          <i-label>Kadugayon sa posisyon karun:</i-label>
          <div class="md:flex md:items-center mb-6">
            <i-input
              type="number"
              min="0"
              class="m-1"
              placeholder="Years"
              v-model="form.yos_current_position"
            />
            <i-input
              type="number"
              min="0"
              class="m-1"
              placeholder="Months"
              v-model="form.mos_current_position"
            />
          </div>
        </div>
      </div>

      <!-- bio info start -->
      <div class="md:flex md:items-center mb-6">
        <div class="m-1 md:w-1/8">
          <i-label>Edad:</i-label>
          <i-input
            type="number"
            min="0"
            class="m-1"
            placeholder="Edad"
            v-model="form.age"
          />
        </div>
        <div class="m-1 ml-10 md:w-2/8">
          <div class="_inline-flex">
            <i-label class="mr-3">Gender:</i-label>
            <br />
            <input
              type="radio"
              name="gender"
              id="maleRadio"
              value="male"
              v-model="form.gender"
              class="ml-5 mt-1.5 scale-150 flex-1"
            />
            <i-label class="flex-1 mx-2" for="maleRadio">Male</i-label>

            <input
              type="radio"
              name="gender"
              id="femaleRadio"
              value="female"
              v-model="form.gender"
              required
              class="mt-1.5 scale-150 flex-1 accent-pink-500"
            />
            <i-label class="flex-1 mx-2" for="femaleRadio">Female</i-label>
          </div>
        </div>
      </div>
      <!-- bio info end -->
      <div class="mt-5"></div>
      <!-- competencies start -->
      <div v-for="(competency, i) in competencies" :key="competency.id">
        <span class="uppercase font-bold"
          >{{ letters[i] }}. {{ competency.id }}</span
        >
        <ol>
          <li
            class="ml-5"
            v-for="(question, q) in competency.questions"
            :key="q"
          >
            {{ `${q + 1}. ${question.question}` }}
            <br />
            <!-- choices radio button start -->
            <div
              class="inline-flex ml-5"
              v-for="(choice, c) in question.choices"
              :key="c"
            >
              <input
                class="mt-1.5 flex-1 accent-purple-700"
                type="radio"
                :name="`${competency.id + q}`"
                :id="`${competency.id + q + c}`"
                :value="choice"
                v-model="
                  form.competencies[`${letters[i]}_${competency.id}_${q}`]
                "
                style="transform: scale(2)"
              />
              <label
                class="flex-1 mx-2 text-gray-700"
                :for="`${competency.id + q + c}`"
                >{{ `${choice[0].toUpperCase()}${choice.slice(1)}` }}</label
              >
            </div>
            <!-- choices radio button end -->
          </li>
        </ol>
      </div>
      <!-- competencies end -->
      <!-- additional info start -->

      <div class="mb-3">
        <label for="textarea1" class="form-label"
          ><h5>
            I. Kung aduna kay ikadugang nga mga kahanas nga gikinahanglan sa
            agri-extension, apan wala gilista sa ibabaw, palihug isulat kini sa
            luna sa ubos.
          </h5></label
        >
        <i-textarea
          id="textarea1"
          rows="3"
          placeholder="..."
          v-model="form.i_additional_information"
        ></i-textarea>
      </div>

      <div class="mb-3">
        <label class="form-label"
          ><h5>
            J. Unsa ang angay nga mga pamaagi aron makuha ang nahisgutan sa
            itaas nga mga core competencies? Palihug i-rate ang matag paagi o
            mekanismo sa sukod nga gihatag sa ubos.
          </h5></label
        >

        <!-- table start -->
        <div class="flex justify-center">
          <table class="border" style="">
            <thead class="border-b">
              <tr>
                <td></td>
                <th scope="col" class="border-r">
                  Mga pamaagi arun makuha ang core competencies
                </th>
                <th scope="col" class="border-r">Dili Angay</th>
                <th scope="col" class="border-r">Medyo Angay</th>
                <th scope="col" class="border-r">Angay</th>
                <th scope="col" class="border-r">Angayan Kaayo</th>
              </tr>
            </thead>
            <tbody>
              <tr
                class="border"
                v-for="(item, j) in j_additional_questions"
                :key="j"
              >
                <td scope="col" class="border-r w-5">
                  <span class="p-2">{{ j + 1 }}.</span>
                </td>
                <td scope="col" class="border-r">
                  <span class="p-2">{{ item.question }}</span>
                </td>
                <td
                  scope="col"
                  class="border-r text-center"
                  v-for="(choice, c) in item.choices"
                  :key="c"
                  style="width: 50px"
                >
                  <!-- <div class="form-check"> -->
                  <input
                    class="mt-1.5 scale-150 flex-1 accent-purple-700"
                    type="radio"
                    :name="`j_item_${j}`"
                    :value="choice"
                    v-model="
                      form.j_additional_information[
                        `j_additional_information_${j}`
                      ]
                    "
                    style="transform: scale(2)"
                  />
                  <!-- </div> -->
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- table end -->
      </div>

      <div class="mb-3">
        <label for="textarea2" class="form-label">
          <h5>
            K. Kung magrekomenda ka ug tulo pa nga mga kalihokan o programa aron
            mapauswag ang mga core competencies sa mga agri-extension
            professionals unsa ang imong mga rekomendasyon?
          </h5>
        </label>
        <i-textarea
          id="textarea2"
          rows="3"
          placeholder="..."
          v-model="form.k_additional_information"
        ></i-textarea>
      </div>

      <i-button class="btn-primary" :disabled="form.processing" type="submit">
        Submit
      </i-button>

      <!-- additional info end -->
    </form>
    <!-- container end -->

    <!-- ################################# -->
  </div>
</template>

<script>
/**
 *
 *
 *
 *
 *
 *
 * */

import ILabel from "@/Components/Label";
import IInput from "@/Components/Input";
import IButton from "@/Components/Button";
import ITextarea from "@/Components/Textarea";
import IToast from "@/Components/Toast";
import GuestLayout from "@/Layouts/Guest.vue";
import { Link } from "@inertiajs/inertia-vue3";

export default {
  props: {
    edit_status: String, //created, updated, or deleted
    edit_form: Object,
  },
  components: {
    GuestLayout,
    Link,
    ILabel,
    IInput,
    IButton,
    ITextarea,
    IToast,
  },
  data() {
    return {
      status: false,
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

  methods: {
    get_title(competency_id) {
      var title = _.toUpper(competency_id);
      return title;
    },
    submit() {
      this.form.post("/pig/2022/assessment-form", {
        onSuccess: () => {
          this.form.reset();
          if (this.edit_status == "created") {
            this.$refs.successToast.showToast();
          }
        },
      });
    },
    set_edit_form() {
      if (!this.edit_form) return false;
      this.form = this.$inertia.form(this.edit_form);
    },
  },
  mounted() {
    // console.log(this.$refs.successToast.toast_save());
    this.set_edit_form();
  },
};
</script>