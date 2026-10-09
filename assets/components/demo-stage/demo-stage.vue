<script>
import Stage from '@wexample/symfony-stage/components/stage/stage.vue';

// A stage as a page drives it: its elements and links held here, a bar of the
// design system above it acting on it, a status bar under it saying what is
// picked. The elements are drawn by the page — a card with a title and a word
// of what the step is — through the stage's `element` slot.
export default {
  template: '#vue-template-wexample-symfony-stage-demo-bundle-components-demo-stage-demo-stage',

  components: {
    Stage
  },

  props: {
    axis: {
      type: String,
      default: 'both'
    },
    initialElements: {
      type: Array,
      default: () => []
    },
    initialLinks: {
      type: Array,
      default: () => []
    }
  },

  data() {
    return {
      elements: this.initialElements,
      links: this.initialLinks,
      selection: [],
      canUndo: false,
      canRedo: false,
      added: 0
    };
  },

  computed: {
    status() {
      const picked = this.selection.length;

      return `${this.elements.length} elements · ${this.links.length} links${picked ? ` · ${picked} picked` : ''}`;
    }
  },

  mounted() {
    this.$nextTick(() => this.$refs.stage.fit());
  },

  methods: {
    renderIcon(name) {
      return this.app.getServiceOrFail('icon').icon(name);
    },

    refreshHistory() {
      this.canUndo = this.$refs.stage.canUndo;
      this.canRedo = this.$refs.stage.canRedo;
    },

    onElements(value) {
      this.elements = value;
      this.$nextTick(() => this.refreshHistory());
    },

    // A step added after the last one picked — or the last one of all —, and
    // linked from it: what a palette would do on a timeline.
    add() {
      const stage = this.$refs.stage;
      const after = this.elements.find((element) => element.id === this.selection.at(-1)) ?? this.elements.at(-1);
      const element = stage.add({
        title: `Step ${++this.added}`,
        kind: 'task',
        x: after ? after.x + after.width + 80 : 40,
        y: after ? after.y : 40,
        width: 160,
        height: 72
      });

      if (after) {
        stage.link(after.id, element.id);
      }
    },

    undo() {
      this.$refs.stage.undo();
    },

    redo() {
      this.$refs.stage.redo();
    },

    remove() {
      this.$refs.stage.removeSelected();
    },

    fit() {
      this.$refs.stage.fit();
    }
  }
};
</script>
