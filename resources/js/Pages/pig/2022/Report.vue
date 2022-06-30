<template>
  <pig>
    <Button class="my-5" @click="$inertia.get('/')" label="Home" />

    <br />
    <!-- {{ datasets }} -->
    <div>
      <div class="card">
        <span class="font-bold">Overall</span>
        <Chart type="bar" :data="stacked_data" :options="stackedOptions" />
      </div>

      <div
        class="card mb-2"
        v-for="(competency, c) in chart_data"
        :key="competency.id"
      >
        <span class="font-bold">{{
          `${c} ${competency.id}`.toUpperCase()
        }}</span>
        <div
          class="ml-5"
          v-for="(question, q) in competency.questions"
          :key="q"
        >
          <span class="font-normal">{{
            q + 1 + ". " + question.question
          }}</span>
          <Chart
            type="bar"
            :data="question.data"
            :options="horizontalOptions"
            :height="25"
          />
        </div>
      </div>
    </div>
  </pig>
</template>
<script>
// PrimeVue Components
import Pig from "@/Layouts/Pig.vue";

export default {
  props: {
    stacked_data: Object,
    chart_data: Array,
    i_additional_information: Array,
    k_additional_information: Array,
  },
  components: {
    Pig,
  },
  data() {
    return {
      basicData: {
        labels: ["Oo", "Medyo", "Wala"],
        datasets: [
          {
            label: "My First dataset",
            backgroundColor: "#42A5F5",
            data: [65, 59, 80],
          },
        ],
      },

      stackedOptions: {
        plugins: {
          tooltips: {
            mode: "index",
            intersect: false,
          },
          legend: {
            labels: {
              color: "#495057",
            },
          },
        },
        scales: {
          x: {
            stacked: true,
            ticks: {
              color: "#495057",
            },
            grid: {
              color: "#ebedef",
            },
          },
          y: {
            stacked: true,
            ticks: {
              color: "#495057",
            },
            grid: {
              color: "#ebedef",
            },
          },
        },
      },

      horizontalOptions: {
        responsive: true,
        indexAxis: "y",
        plugins: {
          legend: {
            display: false,
            labels: {
              color: "#495057",
            },
          },
        },
        scales: {
          x: {
            ticks: {
              min: 0,
              max: 70,
              // stepSize: 1,
              color: "#495057",
            },
            grid: {
              color: "#ebedef",
            },
          },
          y: {
            ticks: {
              color: "#495057",
            },
            grid: {
              color: "#ebedef",
            },
          },
        },
      },
      // competencies
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
    };
  },

  methods: {
    reinitChart() {
      this.$refs.charty.refresh;
      console.log("reinitChart");
    },
  },
  mounted() {},
};
</script>