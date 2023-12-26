<template>
  <PanelItem :index="index" :field="field">
    <template #value>
      <table class="diff-container">
        <thead>
          <tr>
            <th class="diff-title">Old Value</th>
            <th class="diff-title">New Value</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="diff diff-old" v-html="diffHtmlOld"></td>
            <td class="diff diff-new" v-html="diffHtmlNew"></td>
          </tr>
        </tbody>
      </table>
    </template>
  </PanelItem>
</template>

<script>
import { diff_match_patch, DIFF_DELETE, DIFF_INSERT, DIFF_EQUAL } from 'diff-match-patch'

export default {
  props: ['index', 'resource', 'resourceName', 'resourceId', 'field'],

  computed: {
    diffHtmlOld() {
      return this.getDiffHtml(DIFF_DELETE);
    },
    diffHtmlNew() {
      return this.getDiffHtml(DIFF_INSERT);
    },
  },

  methods: {
    getDiffHtml(diffType) {
      if (!this.field.oldValue || !this.field.newValue) {
        return '';
      }

      const dmp = new diff_match_patch();
      const diffs = dmp.diff_main(JSON.stringify(this.field.oldValue, null, 2), JSON.stringify(this.field.newValue, null, 2));
      dmp.diff_cleanupSemantic(diffs);

      const html = [];
      for (let x = 0; x < diffs.length; x++) {
        const op = diffs[x][0];    // Operation (insert, delete, equal)
        const data = diffs[x][1];  // Text of change.
        if (op === diffType || op === DIFF_EQUAL) {
          const style = op === DIFF_INSERT ? 'background: #e6ffe6;' : op === DIFF_DELETE ? 'background: #ffe6e6;' : '';
          html[x] = '<span style="' + style + '">' + data + '</span>';
        } else {
          html[x] = '<span></span>';
        }
      }
      return html.join('');
    },
  },
}
</script>

<style>
.diff-container {
    margin: 1rem;
    margin-top: 1rem;
    overflow: auto;
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
}

.diff {
    white-space: pre-wrap;
    word-wrap: break-word;
    border-top: 0 !important;
    border: 1px solid var(--title-background-color);
    padding: 10px;
    box-sizing: border-box;
    width: 50%;
}

.diff-title {
    background-color: var(--title-background-color);
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    padding: 10px;
}

:root {
    --title-background-color: #f0f0f0;
}

html.dark {
    --title-background-color: #303030;
}
</style>