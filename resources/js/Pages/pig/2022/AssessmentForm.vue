<template>
  <!-- <guest-layout></guest-layout> -->
  <pig>
    <div class="container">
      <!-- ############################################### -->
      <div class="my-5">
        <Button
          class="mr-2"
          @click="$inertia.get('/')"
          label="Home"
          v-if="!edit_form"
        />
        <Button
          class="mr-2"
          @click="$inertia.get('/pig/2022/assessment-forms')"
          label="View Encoded Forms"
          v-if="!edit_form"
        />
        <Button
          class="mr-2 p-button-danger"
          @click="$inertia.get('/pig/2022/assessment-forms')"
          label="Cancel Edit"
          v-if="edit_form"
        />
      </div>
      <!-- <i-toast ref="successToast">Saved!</i-toast> -->
      <form method="post" @submit.prevent="submit()" class="">
        <!-- prime vue start -->
        <div class="grid p-fluid">
          <div class="col-12 md:col-6 field">
            <label for="name" class="font-medium">Pangalan:</label>
            <InputText
              id="name"
              type="text"
              v-model="form.name"
              required
              placeholder="Enter fullname here..."
            />
          </div>
          <div class="col-12 md:col-6 field">
            <label for="function_title" class="font-medium"
              >Function/Title:</label
            >
            <InputText
              id="function_title"
              type="text"
              v-model="form.function_title"
              placeholder="Enter function/title here..."
            />
            <!-- list="titles" -->
            <!-- 
              <datalist id="titles">
                <option
                  v-for="(item, i) in distinct_function_titles"
                  :key="i"
                  :value="item"
                ></option>
              </datalist> -->
          </div>
        </div>
        <div class="grid p-fluid">
          <div class="col-12 md:col-6">
            <label for="name" class="font-medium"
              >Kadugayon sa serbisyo sa Agri-Extension:</label
            >
            <div class="grid p-fluid mt-3">
              <div class="col-12 md:col-6">
                <span class="p-float-label">
                  <InputNumber
                    id="yos_1"
                    v-model="form.yos_agri_extension"
                    :min="0"
                  />
                  <label for="yos_1">No of Years:</label>
                </span>
              </div>
              <div class="col-12 md:col-6">
                <span class="p-float-label">
                  <InputNumber
                    id="mos_1"
                    v-model="form.mos_agri_extension"
                    :min="0"
                  />
                  <label for="mos_1">No of Months:</label>
                </span>
              </div>
            </div>
          </div>
          <div class="col-12 md:col-6">
            <label for="name" class="font-medium"
              >Kadugayon sa Posisyon Karun:</label
            >
            <div class="grid p-fluid mt-3">
              <div class="col-12 md:col-6">
                <span class="p-float-label">
                  <InputNumber
                    id="yos_2"
                    v-model="form.yos_current_position"
                    :min="0"
                  />
                  <label for="yos_2">No of Years:</label>
                </span>
              </div>
              <div class="col-12 md:col-6">
                <span class="p-float-label">
                  <InputNumber
                    id="mos_2"
                    v-model="form.mos_current_position"
                    :min="0"
                  />
                  <label for="mos_2">No of Months:</label>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="grid p-fluid">
          <div class="col-12 md:col-2 field">
            <label for="edad" class="font-medium">Edad:</label>
            <InputNumber
              id="edad"
              :min="0"
              v-model="form.age"
              placeholder="Enter age here..."
            />
          </div>
          <div class="col-12 md:col-2 field">
            <label class="mr-3 font-medium">Gender:</label>
            <br />
            <div class="p-inputgroup">
              <div class="field-radiobutton mr-2">
                <RadioButton
                  name="gender"
                  id="maleRadio"
                  value="male"
                  v-model="form.gender"
                />
                <label for="maleRadio">Male</label>
              </div>
              <div class="field-radiobutton">
                <RadioButton
                  name="gender"
                  id="femaleRadio"
                  value="female"
                  v-model="form.gender"
                />
                <label for="femaleRadio">Female</label>
              </div>
            </div>
          </div>
        </div>
        <!-- bio info end -->
        <div class="mt-5"></div>
        <!-- competencies start -->
        <div v-for="(competency, i) in competencies" :key="competency.id">
          <span class="font-bold">{{
            `${letters[i]}. ${competency.id}`.toUpperCase()
          }}</span>
          <ol>
            <li
              class="ml-5"
              v-for="(question, q) in competency.questions"
              :key="q"
            >
              {{ `${question.question}` }}
              <br />
              <!-- choices radio button start -->
              <div
                class="inline-flex mt-3"
                v-for="(choice, c) in question.choices"
                :key="c"
              >
                <div class="field-radiobutton">
                  <RadioButton
                    class="ml-5"
                    :name="`${competency.id + q}`"
                    :id="`${competency.id + q + c}`"
                    :value="choice"
                    v-model="
                      form.competencies[`${letters[i]}_${competency.id}_${q}`]
                    "
                    style="transform: scale(1.5)"
                  />
                  <label :for="`${competency.id + q + c}`">{{
                    `${choice[0].toUpperCase()}${choice.slice(1)}`
                  }}</label>
                </div>
              </div>
              <!-- choices radio button end -->
            </li>
          </ol>
        </div>
        <!-- competencies end -->
        <!-- additional info start -->
        <div class="mb-3">
          <label for="textarea1" class="form-label uppercase">
            <h4>
              I. Kung aduna kay ikadugang nga mga kahanas nga gikinahanglan sa
              agri-extension, apan wala gilista sa ibabaw, palihug isulat kini
              sa luna sa ubos.
            </h4>
          </label>

          <Textarea
            for="textarea1"
            placeholder="..."
            v-model="form.i_additional_information"
            :autoResize="true"
            rows="5"
            style="width: 100%"
          />
        </div>

        <div class="mb-3">
          <label class="form-label uppercase"
            ><h4>
              J. Unsa ang angay nga mga pamaagi aron makuha ang nahisgutan sa
              itaas nga mga core competencies? Palihug i-rate ang matag paagi o
              mekanismo sa sukod nga gihatag sa ubos.
            </h4></label
          >

          <!-- table start -->
          <div class="w-full">
            <DataTable
              class="mx-auto"
              showGridlines
              :value="j_additional_questions"
              responsiveLayout="scroll"
              dataKey="id"
            >
              <Column header="#">
                <template #body="slotProps">
                  {{ slotProps.index + 1 }}
                </template>
              </Column>
              <Column header="Mga pamaagi arun makuha ang core competencies">
                <template #body="slotProps">
                  {{ slotProps.data.question }}
                </template>
              </Column>
              <template
                v-for="(choice, k) in [
                  'Dili Angay',
                  'Medyo Angay',
                  'Angay',
                  'Angayan Kaayo',
                ]"
                :key="k"
              >
                <Column
                  :header="`${choice}`"
                  headerStyle="width: 5em; text-align: center;"
                  bodyStyle="text-align: center"
                >
                  <template #body="slotProps">
                    <RadioButton
                      :name="`j_item_${slotProps.index}`"
                      :value="slotProps.data.choices[k]"
                      v-model="
                        form.j_additional_information[
                          `j_additional_information_${slotProps.index}`
                        ]
                      "
                      style="transform: scale(1.5)"
                    />
                  </template>
                </Column>
              </template>
            </DataTable>
          </div>
          <!-- table end -->
        </div>

        <div class="mb-3">
          <label for="textarea2" class="form-label uppercase">
            <h4>
              K. Kung magrekomenda ka ug tulo pa nga mga kalihokan o programa
              aron mapauswag ang mga core competencies sa mga agri-extension
              professionals unsa ang imong mga rekomendasyon?
            </h4>
          </label>

          <Textarea
            id="textarea2"
            placeholder="..."
            v-model="form.k_additional_information"
            :autoResize="true"
            rows="5"
            style="width: 100%"
          />
        </div>
        <i-button class="btn-primary" :disabled="form.processing" type="submit">
          Submit
        </i-button>
        <!-- additional info end -->
      </form>
    </div>
    <!-- container end -->
    <!-- ############################################### -->
  </pig>
</template>
<script>
// PrimeVue Components
import Pig from "@/Layouts/Pig.vue";
import ILabel from "@/Components/Label";
import IInput from "@/Components/Input";
import IButton from "primevue/button";
import ITextarea from "@/Components/Textarea";
import IToast from "@/Components/Toast";
import GuestLayout from "@/Layouts/Guest.vue";
import { Link } from "@inertiajs/inertia-vue3";
export default {
  props: {
    distinct_function_titles: Array,
    edit_status: String,
    edit_form: Object,
  },
  components: {
    Pig,
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
        yos_agri_extension: null,
        mos_agri_extension: null,
        yos_current_position: null,
        mos_current_position: null,
        age: null,
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
            // this.$refs.successToast.showToast();
            this.$toast.add({
              severity: "success",
              summary: "Saved!",
              detail: "Form successfully saved!",
              life: 2000,
            });
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
    this.set_edit_form();
  },
};
</script>