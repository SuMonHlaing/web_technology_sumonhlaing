import Bio from "./Bio.js";
import Gallery from "./Gallery.js";
import PersonTodoList from "./Person.js";
import Profile from "./Profile.js";
import TodoList from "./Todo.js";
import { getImageUrl } from './utils.js';


export default function App() {
  return (
    <div>
      <Profile />
      <Gallery />
      <TodoList />
      <Bio  />
      <PersonTodoList />
      <Card>
     
    </Card>
    </div>
  );
}
