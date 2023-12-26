import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
  app.component('index-difference', IndexField)
  app.component('detail-difference', DetailField)
  app.component('form-difference', FormField)
})
