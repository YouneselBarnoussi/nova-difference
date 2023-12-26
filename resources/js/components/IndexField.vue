<template>
  <div>
    <h3 class="removed"> - {{ linesRemoved }}</h3>
    <h3 class="added"> + {{ linesAdded }}</h3>
  </div>
</template>

<script>
import { diff_match_patch, DIFF_DELETE, DIFF_INSERT, DIFF_EQUAL } from 'diff-match-patch'

export default {
  props: ['resourceName', 'field'],

  computed: {
    linesRemoved() {
      return this.getLineCount(DIFF_DELETE, DIFF_EQUAL);
    },
    linesAdded() {
      return this.getLineCount(DIFF_INSERT, DIFF_EQUAL);
    },
  },

  methods: {
    getLineCount(...diffTypes) {
      if (!this.field.oldValue || !this.field.newValue) {
        return 0;
      }

      const dmp = new diff_match_patch();
      const diffs = dmp.diff_main(JSON.stringify(this.field.oldValue, null, 2), JSON.stringify(this.field.newValue, null, 2));
      dmp.diff_cleanupSemantic(diffs);

      let count = 0;
      for (let x = 0; x < diffs.length; x++) {
        const op = diffs[x][0];    // Operation (insert, delete, equal)
        if (diffTypes.includes(op)) {
          const data = diffs[x][1];  // Text of change.
          count += (data.match(/\n/g) || []).length;
        }
      }
      return count;
    },
  },
}
</script>

<style scoped>
.removed {
  color: red;
}

.added {
  color: green;
}
</style>
