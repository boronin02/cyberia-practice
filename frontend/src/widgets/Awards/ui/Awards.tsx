import styles from "./Awards.module.css";
import { Content } from "./Content";

export const Awards = () => {
  return (
    <>
      <section className={styles.awards}>
        <h1 className={styles.title}>Награды студии</h1>
        <div className={styles.info}>
          <Content />
        </div>
      </section>
    </>
  );
};
