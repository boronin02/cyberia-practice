import { Cards } from "./Cards";
import styles from "./Projects.module.css";
import { Tags } from "./Tags";

export const Projects = () => {
  return (
    <>
      <section className={styles.projects}>
        <div className={styles.title}>Наши проекты</div>
        <Tags />
        <Cards />
        <button className={styles.button}>Загрузить еще</button>
      </section>
    </>
  );
};
