import styles from "./Projects.module.css";
import { tags } from "@/entities/projects/model/projects.data";

export const Tags = () => {
  return (
    <>
      <div className={styles.tags}>
        {tags.map((tag) => (
          <div className={styles.tag} key={tag.key}>
            {tag.text}
          </div>
        ))}
      </div>
    </>
  );
};
