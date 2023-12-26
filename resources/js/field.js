import IndexField from './components/IndexField'
import DetailField from './components/DetailField'

Nova.booting((app, store) => {
  app.component('index-difference', IndexField)
  app.component('detail-difference', DetailField)
})
