import { Cards } from "../index";
import styles from "./Projects.module.scss";
import { Tags } from "../index";

export const Projects = () => {
  return (
    <section className={styles.projects}>
      <div className={styles.title}>Наши проекты</div>
      <Tags />
      <Cards />
    </section>
  );
};
